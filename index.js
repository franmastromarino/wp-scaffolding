const fs = require("fs-extra");
const inquirer = require("inquirer");
const path = require("path");
const glob = require("glob");
const program = require("commander");
const { version } = require("../package.json");

const templateDir = path.join(__dirname, "template");

program
  .name("create-plugin")
  .description(
    "Generates PHP, JS and CSS code for registering a WordPress plugin with blocks."
  )
  .version(version)
  .arguments("[name]")
  .action(async (name) => {
    if (!name) {
      const answers = await inquirer.prompt([
        { name: "name", message: "Plugin name?" },
        // Add more prompts as needed
      ]);
      name = answers.name;
    }

    const targetDir = path.join(process.cwd(), name);

    // Copy the template directory to the target directory
    await fs.copy(templateDir, targetDir);

    // Replace placeholders in the copied files
    const files = glob.sync("**", { cwd: targetDir, nodir: true, dot: true });
    for (const file of files) {
      const filePath = path.join(targetDir, file);
      let content = await fs.readFile(filePath, "utf8");
      content = content.replace(/{{name}}/g, name);
      await fs.writeFile(filePath, content);
    }

    console.log(`Plugin created at ${targetDir}`);
  })
  .parse(process.argv);
