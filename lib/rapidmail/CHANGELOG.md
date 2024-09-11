# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.1.6
- Fix issue with API version number from config being passed to Guzzle client instance
See [#20](https://github.com/rapidmail/rapidmail-apiv3-client-php/issues/20) for details. Thanks to 
[schelmo](https://github.com/schelmo) for the current workaround.

## 1.1.5
- [#19](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/19) allow psr/http-message 2.0
(Thganks to [saitho](https://github.com/saitho))

## 1.1.4
- Fixed deprecation warnings caused by use of deprecated variable replacement notation. 

## 1.1.3
- [#15](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/15) fix deprecation message in throttling
middleware (Thanks to [mklewitz](https://github.com/mklewitz))

## 1.1.2
- Add missing #ReturnTypeWillChange attributes
- Fix variable substitution syntax to be compatible with PHP 8.2+

## 1.1.1
- Add #ReturnTypeWillChange attribute to prevent deprecation notices on PHP 8+
- Run tests for PHP 8.1 and 8.2
- Remove ZIP installation instructions 

## 1.1.0
### Added
- [#8](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/8) adds support for PHP 8.0.
- [#8](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/8) adds support for Guzzle7 releases
fixing issue #7
  
### Fixed
- [#8](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/8) fixes base64 content validation
failing with large base64 payloads.

## 1.0.1

### Added

- [#3](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/3) adds support for PHP 7.4.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#4](https://github.com/rapidmail/rapidmail-apiv3-client-php/pull/4) fixes a bug where setting the "updated_since"
filter when listing mailings would instead apply a "created_since" filter (Issue #2)
