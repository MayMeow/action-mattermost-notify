# Action Mattermost Notify

PHP script that can be used to send an message to Mattermost.

```bash
Action Mattermost Notify 1.0.0

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  completion  Dump the shell completion script
  help        Display help for a command
  list        List commands
  send        Send a message to Mattermost
```

To send message with this script use

```bash
action-mattermost-notify send "Your message" --url https://your.mattermost.webhook.url
```

## Action usage

Add following code to your workflow

```bash
- uses: MayMeow/action-mattermost-notify@main # this using main branch instead of published version
  with:
    url: ${{ secrets.MATTERMOST_WEBHOOK }} # required
    message: "Hello world from ${{ github.repository }}" # required
    username: "" # use if you want to change username of message sender
    channel: "" # use if you want to set changel where message will be send
    icon: "" # url of sender's profile icon
```
