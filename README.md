# send-sms-laravel
send sms in laravel for sms.ir

# Install
`composer require devnull-ir/smssender`

# Use 
add To .env File:
```env
UserApiKey_sms=YourUserApiKey
SecretKey_sms=YourSecretKey
LineNumber_sms=YourPhoneTheSite
```
# Functions

`sendCode()`

`sendMessage()`

`get_token_sms()`

# how to send Message

.env File :

```env
UserApiKey_sms=YourUserApiKey
SecretKey_sms=YourSecretKey
LineNumber_sms=3333333333
```

My Code:

```php
sendMessage('Hello',09122222222);
```

# how to Send Otp Code

.env File :

```env
UserApiKey_sms=YourUserApiKey
SecretKey_sms=YourSecretKey
LineNumber_sms=3333333333
```

My Code:

```php
sendCode(6545,09122222222,6523);
```
parametr there a code theme
