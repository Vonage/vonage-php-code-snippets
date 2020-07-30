### Usage

This quick demo shows how to generate a delivery receipt from an incoming request. 

To run this demo:

1. Run `composer install`
2. Start the web server `composer run --timeout=0 serve`
3. Start ngrok with `ngrok http 3000`. ngrok will give you a forwarding address you can now use for your delivery receipts.
4. Copy this URL and go to your [customer dashboard](https://dashboard.nexmo.com/sign-in)
5. Click on your name, then go to ["Settings"](https://dashboard.nexmo.com/settings)
6. Under the "Default SMS Setting", change the "Delivery Receipts" option to `https://your-ngrok-url/webhooks/delivery-receipt`
7. Click "Save Changes"

You can now send an SMS, and delivery receipts will be fowarded to this ngrok
URL. You can check the console output of the server to see the delivery
receipt information.
