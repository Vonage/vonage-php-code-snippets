### Usage

This quick demo shows how the ASR NCCO events work.

To run this demo:

1. Run `composer install`
2. Start the web server `composer run --timeout=0 serve`
3. Start ngrok with `ngrok http 3000`. ngrok will give you a forwarding address you can now use for your delivery receipts.
4. Copy this URL and go to your [customer dashboard](https://dashboard.nexmo.com/sign-in)
5. Go to ["Your Applications"](https://dashboard.nexmo.com/applications)
6. Click the three dots for your application and click "Edit"
7. Under "Capabilities", change the Voice "Answer URL" option to `https://your-ngrok-url//webhooks/asr`
7. Click "Save changes"

You can now call one of the numbers linked to your application. You should be able to speak at the prompt, and 
have the system read back what you said.
