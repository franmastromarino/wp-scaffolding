#!/usr/bin/env node
const { Command } = require("commander");
const fs = require("fs-extra");
const path = require("path");
const glob = require("glob");
const { replacePlaceholders, processPackageJson } = require("../helpers");

const command = new Command("update-plugin")
  .description("Updates an existing plugin")
  .action(async () => {
    const templateDir = path.join(__dirname, "../template");
    const targetDir = process.cwd();
	const preserveFiles = [
		'.git',
		'.github',
		'.distignore',
		'readme.txt',
		'node_modules',
		"package.json",
		"composer.json",
		".wc.json",
		"README.md",
		"plugin-init.php",
		"packages",
		"tests",
		"webpack.config.js",
	  ];

    // Read the files array from package.json
    const packageJson = await processPackageJson(targetDir, templateDir);
    const zipFiles = packageJson?.scaffolding?.zip || [];
	const gitFiles = packageJson?.scaffolding?.git || [];

    const name = packageJson.name;
    const title = packageJson.title;

    // Merge the example files with the excluded files
    preserveFiles.push(...zipFiles);
    preserveFiles.push(...gitFiles);

    // Update the template files
    const templateFiles = glob.sync("**", {
      cwd: templateDir,
      nodir: true,
      dot: true,
    });
    for (const file of templateFiles) {
      // Skip the file if it's in the preserveFiles array or its directory is in the preserveFiles array
      if (preserveFiles.some((excluded) => file.startsWith(excluded))) {
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

    // Delete the files that are not in the template or the preserveFiles array
    const targetFiles = glob.sync("**", {
      cwd: targetDir,
      nodir: true,
      dot: true,
    });
    for (const file of targetFiles) {
      if (
        !templateFiles.includes(file) &&
        !preserveFiles.some((excluded) => file.startsWith(excluded))
      ) {
        await fs.remove(path.join(targetDir, file));
      }
    }

    console.log(`Plugin updated at ${targetDir}`);
  });

module.exports = command;
