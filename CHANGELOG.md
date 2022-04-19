# Changelog

## [Unreleased]

### Security

- spip-team/securite#4336 Appeler `copie_locale()` avec la callback `valider_url_distante()` pour vérifier l'URL finale que l'on copie
- spip-team/securite#4336 Utilisation de l'option `callback_valider_url` dans l'upload de document, pour s'assurer que l'URL d'un document distant est toujours valide après redirections

### Changed

- spip-team/securite#4336 Ajout d'une option `callback_valider_url` sur `renseigner_source_distante()`
