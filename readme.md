# Webpack Bundle for Chameleon Shop (WIP)

## installation
First, install Node.js and also the Yarn or npm Package Manager (yarn is recommended.)
* Install the Bundle via Composer in Chameleon Shop Application
```
 composer.sh require kzorluoglu/chameleon-webpack-bundle:dev-master
 yarn install // or npm install
```

* Add the Bundle in app/AppKernel.php
```
new \kzorluoglu\ChameleonWebpackBundle\kzorluogluChameleonWebpackBundle(),
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


## Configs

* webpack.config.js for production
* webpack.development.config.js for development
