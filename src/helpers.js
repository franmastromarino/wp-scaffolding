#!/usr/bin/env node
const fs = require("fs-extra");
const path = require("path");
// Helper function to replace placeholders in a file
async function replacePlaceholders(filePath, replacements) {
  let content = await fs.readFile(filePath, "utf8");
  for (const [placeholder, replacement] of Object.entries(replacements)) {
    content = content.replace(new RegExp(placeholder, "g"), replacement);
  }
  await fs.writeFile(filePath, content);
}


async function processPackageJson(targetDir, templateDir) {
	// Read the package.json file as a string
	const packageJsonPath = path.join(targetDir, "package.json");
	const packageJsonString = await fs.readFile(packageJsonPath, "utf8");

	// Use dynamic import to get the detect-indent module
	const detectIndent = (await import('detect-indent')).default;
	const detectedIndent = detectIndent(packageJsonString).indent;

	// Parse the package.json string as JSON
	const packageJson = JSON.parse(packageJsonString);

	// Read the template package.json
	const templatePackageJsonPath = path.join(templateDir, "package.json");
	const templatePackageJsonString = await fs.readFile(templatePackageJsonPath, "utf8");
	const templatePackageJson = JSON.parse(templatePackageJsonString);

	// Merge the scripts and lint-staged fields
	packageJson.scripts = templatePackageJson.scripts;
	packageJson['lint-staged'] = templatePackageJson['lint-staged'];

	// Write the updated package.json back to the project with the original indentation
	await fs.writeFile(packageJsonPath, JSON.stringify(packageJson, null, detectedIndent) + '\n');

	return packageJson;
  }

module.exports = {
  replacePlaceholders,
  processPackageJson,
};
