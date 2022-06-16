<?php

class marktView
{
    public function getMarktView()
    {
        return '<div id="marktDiv">
                    <table id="marktUebersichtTable">
                        <thead>
                            <tr id="marktUebersichtHeadZeile">
                                <td class="marktUebersichtHead">aktie</td>
                                <td class="marktUebersichtHead">preis</td>
                                <td class="marktUebersichtHead">tagesDifferenz</td>
                                <td class="marktUebersichtHead">tages start</td>
                            </tr>
                        </thead>
                        <tbody id="marktUebersichtBody">
                             
                        </tbody>
                    </table>
                </div>';
    }
}