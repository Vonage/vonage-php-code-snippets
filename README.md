# Vonage APIs Quickstart Examples for PHP

<img src="vonage_logo.png" height="60px" alt="Vonage logo" />

The purpose of the quickstart guide is to provide simple PHP examples focused on one goal. For example, sending an SMS, receiving an SMS via an incoming SMS webhook or making a Text to Speech call.

Quickstarts also available for [Java](https://github.com/nexmo/nexmo-java-code-snippets), [.NET](https://github.com/nexmo/nexmo-dotnet-code-snippets), [Node.js](https://github.com/nexmo/nexmo-node-code-snippets), [Python](https://github.com/nexmo/nexmo-python-code-snippets), and [Ruby](https://github.com/nexmo/nexmo-ruby-code-snippets)

## Setup

These code samples are meant to be used for [https://developer.vonage.com/](https://developer.vonage.com/), and are structured in such a way as to be used for internal testing. Developers are free to use these code snippets as a reference, but these may require changes to be worked into your specific application. We recommend checking out the [Vonage Developer Website](https://developer.vonage.com/), which displays these code snippets in a more copy/paste fashion.

If you would like to run these examples yourself, you will need to do the following:

1. Run `composer install` in the root of the repository
2. Copy `.env-example` to `.env`
3. Edit `.env` with your Vonage credentials

From there, you can fill out the various environment variables as detailed by the individual code snippet. Some snippets may share common environment variables. 

Larger or more complex snippets may include their own `composer.json` file and have additional requirements. Please check any READMEs inside of the larger examples for setup instructions.

## Configure with Your Vonage API Keys

To use this sample you will first need a [Vonage account](https://dashboard.vonage.com/sign-up). Once you have your own API credentials, rename
the `.env-example` file to `.env` and set the values as required.

For some of the examples, you will need to [buy a number](https://dashboard.vonage.com/buy-numbers).

## Request More Examples

Please [raise an issue](/../../issues/) to request an example that isn't present within the code snippets. Pull requests will be gratefully received.

## Licenses

- The sample code in this repo is licensed under [Apache2](LICENSE.md)

