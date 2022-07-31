<?php
declare(strict_types=1);

namespace Maymeow\ActionMattermostNotify;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

class SendCommand extends Command
{
    protected static $defaultName = 'send';

    /**
     * Configure method
     *
     * @return void
     */
    public function configure(): void
    {
        $this
            ->setDescription('Send a message to Mattermost')
            ->setHelp('This command allows you to send a message to Mattermost');

        $this
            ->addArgument('message', InputArgument::REQUIRED, 'The message to send')
            ->addOption('channel', null, InputOption::VALUE_OPTIONAL, 'The channel to send the message to')
            ->addOption('username', null, InputOption::VALUE_OPTIONAL, 'The username to send the message as')
            ->addOption('icon', null, InputOption::VALUE_OPTIONAL, 'The icon to send the message with')
            ->addOption('url', null, InputOption::VALUE_OPTIONAL, 'The URL to send the message with');
    }

    /**
     * Execute method
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input Input interface
     * @param \Symfony\Component\Console\Output\OutputInterface $output Output interface
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = $input->getArgument('message');
        $channel = $input->getOption('channel');
        $username = $input->getOption('username');
        $icon = $input->getOption('icon');
        $url = $input->getOption('url');

        $client = HttpClient::create();

        $response = $client->request('POST', $url, [
            'body' => json_encode([
                'channel' => $channel,
                'text' => $message,
                'username' => $username,
                'icon_url' => $icon,
            ]),
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $output->writeln($response->getContent());

        return Command::SUCCESS;
    }
}
