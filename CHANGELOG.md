# Changelog

## [4.0.5] - 2022-05-20

### Security

- spip-team/securite#4336 Appeler `copie_locale()` avec la callback `valider_url_distante()` pour vérifier l'URL finale que l'on copie
- spip-team/securite#4336 Utilisation de l'option `callback_valider_url` dans l'upload de document, pour s'assurer que l'URL d'un document distant est toujours valide après redirections

### Changed

- spip-team/securite#4336 Ajout d'une option `callback_valider_url` sur `renseigner_source_distante()`


## [4.0.4] - 2022-04-01

### Fixed

- #4857 (suite) Correction du nom de constante `_IMAGE_TAILLE_MINI_AUTOLIEN`


## [4.0.3] - 2022-03-25

### Changed

- Compatible SPIP 4.1.0 minimum.

### Fixed

- #4857 Utiliser un filtre (surchargeable) et un define `_IMAGE_TAILLE_MINI_AUTOLIEN` pour déterminer le comportement autolien des images


## [4.0.2] - 2022-03-05

### Security

- spip-team/securite#4827 Sécuriser l’insertion d’une galerie dans le formulaires d’ajout de document

### Deprecated

- spip-team/securite#4827 Déprécier l’insertion d’une galerie dans le formulaires d’ajout de document. Ce mode n’est plus utilisé dans SPIP depuis SPIP 3.0.


## [4.0.1] - 2022-02-17

### Added

- Mise à jour des chaînes de langues depuis trad.spip.net


## [4.0.0] - 2022-02-08

### Changed

- Compatibilité PHP 8.1
- Nécessite PHP 7.4 minimum
- Retrait de jQuery multifile
- UP SVG Sanitizer en version 0.14.1
- Up Getid3 en version v1.9.21-202109171300
