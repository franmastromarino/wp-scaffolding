#!/usr/bin/env node
const { Command } = require("commander");
const fs = require("fs-extra");
const inquirer = require("inquirer");
const path = require("path");
const glob = require("glob");
const { replacePlaceholders } = require("../helpers");

const command = new Command("create-plugin")
  .description("Creates a new plugin")
  .action(async () => {
	//TODO: validate command line arguments
    const answers = await inquirer.prompt([
      { name: "name", message: "Plugin name?" },
      { name: "title", message: "Plugin title?" },
      { name: "namespace", message: "Plugin namespace?" },
      // Add more prompts as needed
    ]);
    const name = answers.name;
    const title = answers.title;
    const namespace = answers.namespace;

    const templateDir = path.join(__dirname, "../template");
    const targetDir = process.cwd();

	//TODO: include a progress bar
    // Copy the template directory to the target directory
    await fs.copy(templateDir, targetDir, {
      filter: (src) => {
        // If the file is plugin-init.php, rename it to the plugin name
        if (path.basename(src) === "plugin-init.php") {
			const dest = path.join(targetDir, `${name}.php`);
			fs.copySync(src, dest);
			return false;
		  }
		  // If the file is .gitignore.template, rename it to .gitignore
		  if (path.basename(src) === ".gitignore.template") {
			const dest = path.join(targetDir, '.gitignore');
			fs.copySync(src, dest);
			return false;
		  }
        return true;
      },
    });

    // Replace placeholders in the copied files
    const files = glob.sync("**", { cwd: targetDir, nodir: true, dot: true });
    for (const file of files) {
      const filePath = path.join(targetDir, file);
      await replacePlaceholders(filePath, {
        '{{name}}': name,
        '{{plugin-name}}': name,
        '{{plugin-title}}': title,
        '{{plugin-namespace}}': namespace,
      });
    }

    console.log(`Plugin created at ${targetDir}`);
  });

module.exports = command;
