# SnapSpark: Your Daily Source of Positivity and Inspiration

Step into SnapSpark, the social network dedicated to sharing and celebrating the brightest moments of your day! Capture and share images, and thoughts that bring joy, motivation, and smiles, or use the daily hashtag for inspiration.

## Key Features:

1. **Positive Moments:** Share snapshots of your day that inspire and spread positivity.

2. **Hashtag of the Day:** Join the community by following the hashtag of the day, connecting with users who share your interests.

3. **Quick Reactions:** Respond to others' posts with "sparks" to express appreciation and share positivity.

4. **Inspiration Albums:** Create your personal album of positive moments, a source of inspiration when you need it.

5. **Private Message:** Share with friends and family, but manage your privacy to keep more intimate thoughts private.

6. **Ease of Use:** An intuitive interface for quick sharing, without unnecessary frills.

7. **Spark Ranking:** Earn "sparks" for your content, fueling a culture of positive sharing.

Join SnapSpark and immerse yourself in a light and optimistic community. Here, your day becomes a continuous source of inspiration and smiles!

# Email
    By default the sending of emails is disabled, first it is necessary to carry out some configurations.

# Email configuration
0. First of all you need to create a **password for Application** in your google account (you can name this password **XAMPP localhost**), to do this follow the instrutions at this link:
    https://support.google.com/mail/answer/185833?hl=it#:~:text=Visita%20la%20pagina%20Account%20Google,seleziona%20Password%20per%20le%20app
1. Open xampp\sendmail\sendmail.ini and set this var.
    1. smtp_server=smtp.gmail.com
    2. smtp_port=587
    3. smtp_ssl=tls
    4. decomment ;error_logfile=error.log
    5. decomment ;debug_logfile=debug.log
    6. complete auth_username with your mail
    7. comlete auth_password with the password of **0.**
2. Open xampp\php\php.ini and to this:
    1. check if extension=php_openssl.dll is active
    2. comment SMTP=localhost
    3. comment smtp_port=25
    4. comment sendmail_from
    5. set sendmail_path=C:\precorso per sendmail.exe (in my case sendmail_path=C:\xampp\sendmail\sendmail.exe)

# Activate mail
To activate mails you need do decomment some lines:
1. Go in file utils\notification.php and decomment the line after /*Mail*/, this is to receive an email when you receive a notification in your profile.
2. Go in file modify-create-account.php and deccoment the line after /*Mail*/, this is to receive an email when you create a new profile.
3. Go in file utils\mail.php and insert your mail in the variable **$from**
