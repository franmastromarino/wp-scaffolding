#!/usr/bin/env node
const fs = require("fs-extra");
// Helper function to replace placeholders in a file
async function replacePlaceholders(filePath, replacements) {
  let content = await fs.readFile(filePath, "utf8");
  for (const [placeholder, replacement] of Object.entries(replacements)) {
    content = content.replace(new RegExp(placeholder, "g"), replacement);
  }
  await fs.writeFile(filePath, content);
}

module.exports = {
  replacePlaceholders,
};
