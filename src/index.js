#!/usr/bin/env node
const program = require("commander");
const versionCommand = require("./commands/version");
const createPluginCommand = require("./commands/create-plugin");
const updatePluginCommand = require("./commands/update-plugin");

program
	.addCommand(versionCommand)
	.addCommand(createPluginCommand)
  	.addCommand(updatePluginCommand)
  	.parse(process.argv);
