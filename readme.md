# Webpack Bundle for Chameleon Shop (WIP)

## installation
* First, install Node.js and also the Yarn or npm Package Manager (yarn is recommended.)
* Install the Bundle via Composer in Chameleon Shop Application
```
 composer.sh require kzorluoglu/chameleon-webpack-bundle:dev-master
```

* Add the Bundle in app/AppKernel.php
```
new \kzorluoglu\ChameleonWebpackBundle\kzorluogluChameleonWebpackBundle(),
```

* Create the Webpack Assets for Project
```
app/console chameleon_system:webpack:create-assets
```

* Install NPM Packages
```
 yarn install // or npm install
```

## Usage

* Build for Production
```
npm run webpack 
```

* Build for Development
```
npm run webpack:dev 
```
* hot-reload/watch
```
npm run webpack:dev:watch
```


## Configs

* webpack.config.js for production
* webpack.development.config.js for development
