#!/bin/sh

action-mattermost-notify send "$1" --url "$2" --channel "$3" --username "$5" --icon "$4"
