
<html >
<body>
    
{{-- header --}}
<td align="center">
    <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border: 1px solid #dbd9d9; ">
        <tbody>
            <tr>
                <td height="35"></td>
            </tr>
            <tr>
                <td align="center">
                    <img src="{{asset('images/optimizeit-web-logo.png?ver=1')}}" alt="" width="150">
                </td>
            </tr>
            <tr>
                <td height="35"></td>
            </tr>
        </tbody>
    </table>
</td>
  {{-- content Start --}}
  <tr>
    <td align="center">
        <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border: 1px solid #dbd9d9; ">
        <tbody>
            <tr>
                <td height="35"></td>
            </tr>

            {{-- <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:22px; font-weight: bold; color:#2a3a4b;">Follow Up! ({{$follow_up_date}})</td>

            </tr> --}}

            <tr>
                <td height="10"></td>
            </tr>


            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:20px;  color:#2a3a4b; padding: 12px 22px;">Contact Form</td>
            </tr>
            
            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:16px;  color:#2a3a4b; padding:10px;">
                    <b>Name :  </b>{{ $name }}</td>
            </tr>
            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:16px;  color:#2a3a4b; padding:10px;">
                    <b>Email :  </b>{{ $email }}</td>
            </tr>
            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:16px;  color:#2a3a4b; padding:10px;">
                    <b>Questions :  </b>{{ $question }}</td>
            </tr>
            <tr>
                <td height="10"></td>
            </tr>
            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:18px; color:#2a3a4b; line-height:24px; font-weight: 300; padding:0px 20px; text-indent: 20px;">
                    {{ $msg }}
                </td>
            </tr>
            <tr>
                <td height="20"></td>
            </tr>

            <tr>
                <td height="50"></td>
            </tr>
        </tbody>
    </table>
    </td>
</tr>
{{-- content end --}}

{{-- footer --}}
<td align="center" style="margin-top:2rem">
    <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border: 1px solid #dbd9d9; ">
        <tbody>
            <tr>
                <td height="25"></td>
            </tr>
            <tr>
                <td align="center" style="font-family: 'Raleway', sans-serif;">
                    © 2023 OptimizeIT LLC, by optimizeit.ai Privacy Policy | Terms and Conditions | Disclaimer
                </td>
            </tr>
            <tr>
                <td height="25"></td>
            </tr>
        </tbody>
    </table>
</td>
</body>
</html>