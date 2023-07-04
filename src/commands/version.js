#!/usr/bin/env node
const { Command } = require("commander");

const packageJson = require('../../package.json');

const command = new Command("version")
  .description("Creates a new plugin")
  .version(packageJson.version)
  .command('version')
  .description('display the version of the package')
  .action(() => {
    console.log(packageJson.version);
  });

module.exports = command;
