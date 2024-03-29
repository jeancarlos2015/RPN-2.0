<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

    <tr>
        <td align="center">
            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                <tr>
                    <td align="center"
                        style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
                        class="main-header">
                        <!-- section text ======-->

                        <div style="line-height: 35px">

                            Bem Vindo ao Sistema de Repositórios de Processos de Negócio - <span
                                    style="color: #5caad2;">RPN</span>

                        </div>
                    </td>
                </tr>

                <tr>
                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                            <tr>
                                <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="left">
                        <table border="0" width="590" align="center" cellpadding="0" cellspacing="0"
                               class="container590">
                            <tr>
                                <td align="left"
                                    style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                    <!-- section text ======-->


                                    <p style="line-height: 24px; margin-bottom:15px;">

                                        Primeiramente,

                                    </p>
                                    <p style="line-height: 24px;margin-bottom:15px;">
                                        @if(!empty($repositorio))
                                            O seu usuário foi {!! $atividade !!} ao
                                            repositório {!! $repositorio->nome !!} pelo
                                            administrador {!! Auth::user()->name !!}, responsável por criar os
                                            repositórios usados
                                            pelos Usuários.
                                            @else
                                            O seu usuário foi {!! $atividade !!}  pelo
                                            administrador {!! Auth::user()->name !!}, responsável por criar os
                                            repositórios usados
                                            pelos Usuários.
                                        @endif
                                    </p>
                                    <p style="line-height: 24px; margin-bottom:20px;">
                                        Você pode acessar o sistema através do link abaixo:
                                    </p>
                                    <table border="0" align="center" width="180" cellpadding="0" cellspacing="0"
                                           bgcolor="5caad2" style="margin-bottom:20px;">

                                        <tr>
                                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td align="center"
                                                style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">
                                                <!-- main section button -->

                                                <div style="line-height: 22px;">
                                                    <a href="http://projetolaravel.herokuapp.com"
                                                       style="color: #ffffff; text-decoration: none;">MINHA CONTA</a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                        </tr>

                                    </table>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


            </table>

        </td>
    </tr>

    <tr>
        <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
    </tr>

</table>