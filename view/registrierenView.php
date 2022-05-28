<?php

class registrierenView
{
    public function getRegistrierenView()
    {
        return '
        <div>
            <table>
                <tbody><form id="registrierenForm" method="post" action="registrieren"><input type="hidden" name="registrieren"></form>
                    <tr>
                        <td><h1>Registrieren</h1></td>
                    </tr>
                    <tr class="hiddenErrorTr">
                        <td id="hiddenErrorVorname"></td>
                    </tr>
                    <tr>
                         <td><input form="registrierenForm" type="text" placeholder="Vorname" name="vorname" id="formVorname"></td>          
                    </tr>
                    <tr class="hiddenErrorTr">
                        <td id="hiddenErrorNachname"></td>
                    </tr>
                    <tr>
                         <td><input form="registrierenForm" type="text" placeholder="Nachname" name="nachname" id="formNachname"></td>          
                    </tr>
                    <tr class="hiddenErrorTr">
                        <td id="hiddenErrorEmail"></td>
                    </tr>
                    <tr>
                         <td><input form="registrierenForm" type="text" placeholder="email" name="email" id="formEmail"></td>          
                    </tr>
                    <tr class="hiddenErrorTr">
                        <td id="hiddenErrorAlter"></td>
                    </tr>
                    <tr>
                         <td>Geburtstag<input  form="registrierenForm" type="date" name="geburtstag" id="formGeburtstag"></td>          
                    </tr>
                    <tr class="hiddenErrorTr">
                        <td id="hiddenErrorPasswort"></td>
                    </tr>
                    <tr>
                         <td><input form="registrierenForm" type="password" placeholder="Passwort" name="passwort" id="formPasswort" autocomplete="on"></td>          
                    </tr>
                    <tr>
                         <td><input form="registrierenForm" type="password" placeholder="Passwort-Wiederholung" name="passwortW" id="formPasswortW" autocomplete="on"></td>          
                    </tr>
                    <tr>
                        <td><button form="registrierenForm" type="submit" id="registrierenButton">registrieren</button></td>
                    </tr>
                </tbody>
            </table>
        </div>    
        ';
    }
}