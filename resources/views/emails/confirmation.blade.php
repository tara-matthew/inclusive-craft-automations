<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <style>
        td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" media="screen">
    <style>
        .hover-bg-black:hover {
            background-color: #000001 !important
        }
        .hover-text-white:hover {
            color: #fffffe !important
        }
        .m-auto {
            margin-left: auto !important;
            margin-right: auto !important;
        }
        .p-8 {
            padding: 32px !important
        }
        .text-center {
            text-align: center !important
        }
        .max-w-700 {
            max-width: 700px !important
        }
        .w-224 {
            width: 224px !important
        }
        .bg-white {
            background-color: #fffffe !important
        }
        .rounded-full {
            border-radius: 9999px !important
        }
        .max-w-full {
            max-width: 100% !important
        }
        .align-middle {
            vertical-align: middle !important
        }
        .px-3 {
            padding-left: 12px !important;
            padding-right: 12px !important
        }
        .font-medium {
            font-weight: 500 !important
        }
        .tracking-wide {
            letter-spacing: 0.1em !important
        }
        .text-46 {
            font-size: 46px !important
        }
        .text-black {
            color: #000001 !important
        }
        .mb-6 {
            margin-bottom: 24px !important
        }
        .text-2xl {
            font-size: 24px !important
        }
        .font-thin {
            font-weight: 100 !important
        }
        .tracking-wider {
            letter-spacing: 0.01em !important
        }
        .text-base {
            font-size: 16px !important
        }
        .mb-8 {
            margin-bottom: 32px !important
        }
        .cursor-pointer {
            cursor: pointer !important
        }
        .border-black {
            border: 1px solid #000001 !important
        }
        .p-2 {
            padding: 8px !important
        }
        .no-underline {
            text-decoration: none !important
        }
        .mr-2 {
            margin-right: 8px !important
        }
        .no-underline {
            text-decoration-line: none !important
        }
        @media (max-width: 600px) {
            .sm-w-200px {
                width: 200px !important
            }
            .sm-max-w-full {
                max-width: 100% !important
            }
            .sm-p-3 {
                padding: 12px !important
            }
        }
    </style>
</head>
<body style="margin: 0; width: 100%; padding: 0; -webkit-font-smoothing: antialiased; word-break: break-word">
<div role="article" aria-roledescription="email" aria-label lang="en">
    <div>
        <div class="sm-p-3 sm-max-w-full m-auto p-8 max-w-700">
            <div>
                <div style="background: linear-gradient(#fff, #fff);" class="w-224 rounded-full bg-white sm-w-200px m-auto">
                    <img class="sm-w-200px max-w-full align-middle w-224" src="https://ci3.googleusercontent.com/meips/ADKq_Na0tf6Gaqmoj9Xs9yA61q4Kc0qLK1YhMy6yAs5oNl6vV0bzZMHs3eFi9RDnMktIE53SdS_vQ5vb8Nw9wpa35SLlMGvedr5DcRD0AzaWM7r6lRFhOvccGiBFBcEgVjNd2jzASHr53iOpbYG7u2llouNySvYGFi5dMy81VYPMXn8j_268stcZ1V9kDqhQpVl_20E6R--scu_7WJjPi_Lf7bK558t0npkIZJWWyYzAsmgaaju2rMbVjQ=s0-d-e1-ft#https://static.wixstatic.com/media/6380cb_db1bf159fbef47ed8df9647aa01714e7~mv2.png/v1/fit/w_448,h_2000,al_c,q_85/6380cb_db1bf159fbef47ed8df9647aa01714e7~mv2.png" alt="logo" width="224">
                </div>
            </div>
            <div class="px-3 text-center font-medium tracking-wide">
                <p class="text-46 text-black" style="font-family: 'Montserrat', Helvetica, Arial, serif;">THANKS FOR GETTING IN TOUCH</p>
            </div>
            <div class="mb-6 text-center">
                <p class="text-2xl font-thin tracking-wider text-black" style="font-family: 'Montserrat', Helvetica,Arial, serif;">Your appointment has been confirmed for
                    <br> {{ $appointment->scheduled_at->format('F jS \a\t g:i a') }}.
                </p>
                <p class="text-base font-thin tracking-wider text-black" style="font-family: 'Montserrat', Helvetica,Arial, serif;">
                    Need to reschedule? Email or call to get in touch.
                </p>
                <p class="mb-8 text-base font-thin tracking-wider text-black" style="font-family: 'Montserrat', Helvetica,Arial, serif;">
                    Take a look at my website for some ideas.
                </p>
                <a class="cursor-pointer border-black p-2 text-base font-thin tracking-wider text-black no-underline hover-bg-black hover-text-white" style="font-family: 'Montserrat', Helvetica,Arial, serif;" href="#">Go to Site</a>
            </div>
            <div class="text-center">
                <a href="https://www.instagram.com" class="mr-2 no-underline">
                    <img class="max-w-full align-middle" width="25" height="25" src="https://img.icons8.com/?size=100&id=85154&format=png&color=3A3A3A" alt="instagram">
                </a>
                <a href="https://www.facebook.com/people/Inclusive-Craft-Co/61575127356212/" class="mr-2 no-underline">
                    <img class="max-w-full align-middle" width="25" height="25" src="https://img.icons8.com/?size=100&id=118490&format=png&color=3A3A3A" alt="facebook-new">
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
