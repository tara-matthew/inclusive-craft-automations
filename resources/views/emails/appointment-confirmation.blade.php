<head>
    <meta charset="UTF-8">
</head>

<div>
    <div style="background-color: #f5f3ee;>
        <div style="text-align: center;">
            <img src="https://ci3.googleusercontent.com/meips/ADKq_Na0tf6Gaqmoj9Xs9yA61q4Kc0qLK1YhMy6yAs5oNl6vV0bzZMHs3eFi9RDnMktIE53SdS_vQ5vb8Nw9wpa35SLlMGvedr5DcRD0AzaWM7r6lRFhOvccGiBFBcEgVjNd2jzASHr53iOpbYG7u2llouNySvYGFi5dMy81VYPMXn8j_268stcZ1V9kDqhQpVl_20E6R--scu_7WJjPi_Lf7bK558t0npkIZJWWyYzAsmgaaju2rMbVjQ=s0-d-e1-ft#https://static.wixstatic.com/media/6380cb_db1bf159fbef47ed8df9647aa01714e7~mv2.png/v1/fit/w_448,h_2000,al_c,q_85/6380cb_db1bf159fbef47ed8df9647aa01714e7~mv2.png"  alt="logo"/>
        </div>

        <p style="color: #656b14; font-family: georgia,serif; font-size: 46px;">Hello {{ implode(' and ', $appointment->customer_names) }},</p>

        <p style="color: #656b14; font-family: georgia,serif; font-size: 46px;">Your appointment has been confirmed for {{ $appointment->scheduled_at->format('l jS F') }}
            at {{ $appointment->scheduled_at->format('g:i A') }}.</p>
    </div>
</div>
