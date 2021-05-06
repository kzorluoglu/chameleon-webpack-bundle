<?php
namespace kzorluoglu\ChameleonWebpackBundle\Console\Command;

use kzorluoglu\ChameleonWebpackBundle\Interfaces\AssetCreatorInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateWebpackAssetsCommand extends Command
{
    protected static $defaultName = 'chameleon_system:webpack:create-assets';
    private AssetCreatorInterface $assetCreator;

    public function __construct(string $name = null, AssetCreatorInterface $assetCreator)
    {
        parent::__construct($name);
        $this->assetCreator = $assetCreator;
    }

    protected function configure()
    {
        $this->setDescription('Create Webpack Assets in Chameleon Application')
            ->setHelp('This command allows you to create webpack configs, package.json and etc. for your chameleon application');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '',
            'Chameleon System | Webpack Assets Creator',
            '=========================================',
            'Copying default assets in to Chameleon Project...',
        ]);
        foreach ($this->assetCreator->getAssets() as $file) {
            try {
                $this->assetCreator->copy($file);
                $output->writeln(sprintf('<info>File <fg=black;bg=cyan>%s</> copied in to root project folder.</info>', $file->getFileName()));
            } catch (Exception $e) {
                $output->write(sprintf('ERROR!. Exception %s',$e->getMessage()));
            }
        }
        $output->writeln([
            '',
            'Please install first the depedencies',
            '<info><fg=black;bg=cyan>npm install</> or <fg=black;bg=cyan>yarn install</></info>',
            '',
            '<info>Build for development: <fg=black;bg=cyan>npm run webpack:dev</> or <fg=black;bg=cyan>yarn run webpack:dev</></info>',
            '<info>Build for production: <fg=black;bg=cyan>npm run webpack</> or <fg=black;bg=cyan>yarn run webpack:dev</></info>'
        ]);
        return 0;
    }
}
