let startpreise = null;

const setStartpreise = (daten)=>
{
    for(let el in daten)
    {
        startpreise[daten[el]['id']] = daten[el]['tagesStart']
    }
}

const createHtml = (datenElement) =>
{
    startpreise[datenElement['id']] = datenElement['tagesStart']

    const tr = document.createElement('tr')
    tr.className = 'marktUebersichtZeile'
    tr.id = 'id=' + datenElement['id']

    const tdAktie = document.createElement('td')
    const tdPreis = document.createElement('td')
    const tdTagesdifferenz = document.createElement('td')
    const tdTagesStart = document.createElement('td')

    tdAktie.innerText = datenElement['name']
    tdPreis.innerText = datenElement['preis']
    tdTagesdifferenz.innerText = berechnePreisDiff(datenElement['tagesStart'], datenElement['preis']) + '%'
    tdTagesStart.innerText = datenElement['tagesStart']

    tdAktie.className = 'marktUebersichtDaten'
    tdPreis.className = 'marktUebersichtDaten'
    tdTagesdifferenz.className = 'marktUebersichtDaten'
    tdTagesStart.className = 'marktUebersichtDaten'

    tdAktie.id = 'name'
    tdPreis.id = 'preis'
    tdTagesdifferenz.id = 'tagesdifferenz'
    tdTagesStart.id = 'tagesStart'

    tr.appendChild(tdAktie)
    tr.appendChild(tdPreis)
    tr.appendChild(tdTagesdifferenz)
    tr.appendChild(tdTagesStart)

    const marktUebersichtBody = document.getElementById('marktUebersichtBody')
    marktUebersichtBody.appendChild(tr)
}

const berechnePreisDiff = (startpreis, aktuellerPreis)=>
{
    return ((aktuellerPreis - startpreis) / startpreis * 100).toFixed(3)
}

const updateDaten = (datenElement)=>
{
    const tr = document.getElementById('id=' + datenElement['id'])
    const childNodes = tr.children
    const tagesDiff = parseInt(berechnePreisDiff(startpreise[datenElement['id']], datenElement['preis']))

    if (parseInt(childNodes['preis'].innerText) <= datenElement['preis'])
    {
        childNodes['preis'].style.backgroundColor = 'green'
    }
    else if (parseInt(childNodes['preis'].innerText) >= datenElement['preis'])
    {
        childNodes['preis'].style.backgroundColor = 'red'
    }
    else
    {
        childNodes['preis'].style.backgroundColor = 'lightgrey'
    }

    if(tagesDiff < 0)
    {
        childNodes['tagesdifferenz'].style.color = 'red'
    }
    else
    {
        childNodes['tagesdifferenz'].style.color = 'green'
    }

    childNodes['preis'].innerText = datenElement['preis']
    childNodes['tagesdifferenz'].innerText = tagesDiff + '%'
}

const run = ()=>
{
    const xhr = new XMLHttpRequest()

    xhr.open('POST', '/ajax')
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    if(startpreise === null)
    {
        xhr.send('ajaxMarktdaten=getUebersicht')
    }
    else
    {
        xhr.send('ajaxMarktdaten=getUebersicht&optional=preis')
    }

    xhr.onreadystatechange = ()=>
    {
        if(xhr.status === 200 && xhr.readyState === 4)
        {
            const daten = JSON.parse(xhr.response)
            const marktBody = document.getElementById('marktUebersichtBody')

            if(startpreise === null)
            {
                startpreise = {}
                setStartpreise(daten)
                for(let el in daten)
                {
                    createHtml(daten[el])
                }
            }

            if(marktBody.childElementCount === 0)
            {
                for(let el in daten)
                {
                    createHtml(daten[el])
                }
            }
            else
            {
                for(let el in daten)
                {
                    updateDaten(daten[el])
                }
            }
            return JSON.parse(xhr.response)
        }
    }
}

run()

setInterval(()=>
{
    run()

},10000)



