# Changelog

## [Unreleased]

### Security

- spip-team/securite#4832 et spip-team/securite#4833 appliquer `_TRAITEMENT_TYPO` sur le champ `CREDITS` et bien visualier le html suspect

### Added

- Fichier `README.md`

### Changed

- Compatible SPIP 4.2.0-dev

### Removed

- Suppression du formulaire `FORMULAIRE_CHANGER_FICHIER_DOCUMENT` qui n'est plus utilisé par SPIP (la fonctionnalité se trouve directement dans `FORMULAIRE_EDITER_DOCUMENT`)

### Fixed

- #4902 Suppression des boutons excédentaires de sens de tri sur certaines listes de documents
- #4893 Il ne faut pas contraindre la taille des SVG
- #4891 Amélioration du message d’erreur de taille de document
- #4889 Refaire un alter sur la champ mode avant la migration des logos, par précaution
