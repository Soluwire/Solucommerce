@component('mail::message')
# Registered Successfully!
<hr>
Dear {{ ucwords(strtolower($name)) }},

Thank you for registering for {{env("APP_NAME")}} 



Thanks,<br>

{{ config('app.name') }}

@component('mail::subcopy')
If you have any issues, or questions please contact us- <a href="mailto:{{env("SUPPORT_MAIL")}}">{{env("SUPPORT_MAIL")}}</a>, <br><h5 style="color:Red">DO NOT REPLY TO THIS EMAIL. THIS EMAIL ADDRESS IS UNMONITORED.</h5>
@endcomponent


@endcomponent

