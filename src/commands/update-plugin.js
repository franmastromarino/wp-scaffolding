const { Command } = require("commander");
const fs = require("fs-extra");
const path = require("path");
const glob = require("glob");
const { replacePlaceholders } = require("../helpers");

const command = new Command("update-plugin")
  .description("Updates an existing plugin")
  .action(async () => {
    const templateDir = path.join(__dirname, "../template");
    const targetDir = process.cwd();

    // Read the files array from package.json
    const packageJson = require(path.join(targetDir, "package.json"));
    const excludedFiles = packageJson.files || [];
    const name = packageJson.name;
    const title = packageJson.title;

    const exampleFiles = [
      "package.json",
      "composer.json",
      ".wc.json",
      "README.md",
      "plugin-init.php",
      "packages",
      "tests",
      "webpack.config.js",
    ];

    // Merge the example files with the excluded files
    excludedFiles.push(...exampleFiles);

    // Update the template files
    const templateFiles = glob.sync("**", {
      cwd: templateDir,
      nodir: true,
      dot: true,
    });
    for (const file of templateFiles) {
      // Skip the file if it's in the excludedFiles array or its directory is in the excludedFiles array
      if (excludedFiles.some((excluded) => file.startsWith(excluded))) {
        continue;
      }

      const srcPath = path.join(templateDir, file);
      const destPath = path.join(targetDir, file);

      // Overwrite the file in the target directory with the file from the template directory
      await fs.copy(srcPath, destPath);

      // Replace placeholders in the copied file
      await replacePlaceholders(destPath, {
        "{{name}}": name,
        "{{plugin-name}}": name,
        "{{plugin-title}}": title,
        // "{{plugin-namespace}}": namespace,
      });
    }

    // Delete the files that are not in the template or the excludedFiles array
    const targetFiles = glob.sync("**", {
      cwd: targetDir,
      nodir: true,
      dot: true,
    });
    for (const file of targetFiles) {
      if (
        !templateFiles.includes(file) &&
        !excludedFiles.some((excluded) => file.startsWith(excluded))
      ) {
        await fs.remove(path.join(targetDir, file));
      }
    }

    console.log(`Plugin updated at ${targetDir}`);
  });

module.exports = command;
