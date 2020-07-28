### Usage

This quick demo shows how to receive an inbound SMS message.

To run this demo:

1. Run `composer install`
2. Start the web server `composer run --timeout=0 serve`
3. Start ngrok with `ngrok http 3000`. ngrok will give you a forwarding address you can now use for your messages.
4. Copy this URL and go to your [customer dashboard](https://dashboard.nexmo.com/sign-in)
5. Click on "Numbers", then ["Your Numbers"](https://dashboard.nexmo.com/your-numbers)
6. Click the "Edit" icon for the number you want to receive the SMS message
6. Under the "SMS" section, change the "Inbound Webhook URL" option to `https://your-ngrok-url/webhooks/webhooks/inbound-sms`
7. Click "Save"

You can now send an SMS to the number you just configured, and the message will
be forwarded to the webhook URL. You can view the console output to see the
message information.
