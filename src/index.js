#!/usr/bin/env node
const program = require("commander");
const createPluginCommand = require("./commands/create-plugin");
const updatePluginCommand = require("./commands/update-plugin");

program
  .addCommand(createPluginCommand)
  .addCommand(updatePluginCommand)
  .parse(process.argv);
