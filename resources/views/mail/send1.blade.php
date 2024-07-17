<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
    <tbody>
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                    <tbody>
                        <tr>
                            <td style="padding:36px 48px;display:block">
                                <h1 style="font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff;background-color:#96588a">
                                    Dear {{ $customer->name }} !
                                </h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="600">
                    <tbody>
                        <tr>
                            <td valign="top" style="background-color:#ffffff">
                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="padding:48px 48px 32px">
                                                <div style="color:#636363;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                    <p style="margin:0 0 16px">Naruto Shop xin xác nhận đơn hàng của bạn</p>
                                                    
                                                    <div style="margin-bottom:40px">
                                                        <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                            <tbody>
                                                            @foreach ($orders as $cart)
                                                                
                                                                <tr>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                                    Mã Đơn Hàng: {{ $cart->id }}
                                                                    </td>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                        {{ $cart->pty }}
                                                                    </td>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                        {{ number_format($cart->price, 0, ',', '.') }} VNĐ
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <table cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" width="50%" style="text-align:left;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border:0;padding:0">
                                                                    <h2 style="color:#96588a;display:block;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                                        Thông tin người nhận
                                                                    </h2>
                                                                    <address style="padding:12px;color:#636363;border:1px solid #e5e5e5">
                                                                        {{ $customer->name }}<br>{{ $customer->address }}<br><a href="tel:{{ $customer->phone }}" style="color:#96588a;font-weight:normal;text-decoration:underline" target="_blank">{{ $customer->phone }}</a>
                                                                    </address>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style="margin:0 0 16px">
                                                        Chúng tôi đang tiến hành hoàn thiện đơn đặt hàng của bạn
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>