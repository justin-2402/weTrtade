document.getElementById('registrierenButton').addEventListener('click',
    (e)=>
    {
        e.preventDefault()
        this.vorname = document.getElementById('formVorname').value
        this.nachname = document.getElementById('formNachname').value
        this.email = document.getElementById('formEmail').value
        this.geburtstag = document.getElementById('formGeburtstag').value
        this.passwort = document.getElementById('formPasswort').value
        this.passwortW =document.getElementById('formPasswortW').value

        const vornamePruefung = ()=>
        {
            if(this.vorname === '')
            {
                document.getElementById('hiddenErrorVorname').innerText = 'bitte Vorname ausfüllen'
                return false
            }
            else if(/[^a-zA-Z]/.test(this.vorname))
            {
                document.getElementById('hiddenErrorVorname').innerText = 'der Vorname darf nur buchstaben enthalten'
                return false
            }
            else
            {
                document.getElementById('hiddenErrorVorname').innerText = ''
                return true
            }
        }

        const nachnamePruefung = ()=>
        {
            if(this.nachname === '')
            {
                document.getElementById('hiddenErrorNachname').innerText = 'bitte Nachname ausfüllen'
                return false
            }
            else if(/[^a-zA-Z]/.test(this.nachname))
            {
                document.getElementById('hiddenErrorNachname').innerText = 'der Nachname darf nur buchstaben enthalten'
                return false
            }
            else
            {
                document.getElementById('hiddenErrorNachname').innerText = ''
                return true
            }
        }

        const emailPruefung = ()=>
        {
            if(this.email === '')
            {
                document.getElementById('hiddenErrorEmail').innerText = 'bitte Email ausfüllen'
                return false
            }
            else if(/[^ßa-zA-Z0-9.@-_]/.test(this.email))
            {
                document.getElementById('hiddenErrorEmail').innerText = 'die Email darf nur groß/kleinbuchstaben zahlen punkte und @ enthalten'
                return false
            }
            else
            {
                document.getElementById('hiddenErrorEmail').innerText = ''
                return true
            }

        }

        const alterPruefung = ()=>
        {
            const zeit = new Date()
            const mindestalter = 18

            const mindestalterObj =
                {
                    'tag':zeit.getDate(),
                    //+1 weil die monate bei 0 anfangen
                    'monat':zeit.getMonth()+1,
                    //-18 weil das mindestalter 18 ist
                    'jahr':zeit.getFullYear() - mindestalter
                }

            const userGeburtstag = this.geburtstag.split('-')

            const userGeburtstagObj =
                {
                'tag': parseInt(userGeburtstag[2]),
                'monat': parseInt(userGeburtstag[1]),
                'jahr': parseInt(userGeburtstag[0])

            }

            if(userGeburtstagObj['jahr'] < mindestalterObj['jahr'])
            {
                document.getElementById('hiddenErrorAlter').innerText = ''
                return true
            }
            else if(userGeburtstagObj['jahr'] <= mindestalterObj['jahr'] &&
                    userGeburtstagObj['monat'] < mindestalterObj['monat '])
            {
                document.getElementById('hiddenErrorAlter').innerText = ''
                return true
            }
            else if(userGeburtstagObj['jahr'] <= mindestalterObj['jahr'] &&
                    userGeburtstagObj['monat'] <= mindestalterObj['monat'] &&
                    userGeburtstagObj['tag'] <= mindestalterObj['tag'])
            {
                document.getElementById('hiddenErrorAlter').innerText = ''
                return true
            }
            else
            {
                document.getElementById('hiddenErrorAlter').innerText = 'du musst mindestens 18 sein'
                return false
            }
        }

        const passwortPruefung = ()=>
        {
            if(this.passwort === '' || this.passwortW === '')
            {
                document.getElementById('hiddenErrorPasswort').innerText = 'bitte passwörter eingeben'
                return false
            }
            else if(!/[a-z]/.test(this.passwort) || !/[A-Z]/.test(this.passwort) || !/[0-9]/.test(this.passwort))
            {
                document.getElementById('hiddenErrorPasswort').innerText = 'das passwort muss mindestens groß/kleinbuchstaben und zahlen enthalten'
                return false
            }
            else if(this.passwort.length < 10)
            {
                document.getElementById('hiddenErrorPasswort').innerText = 'das passwort muss mindestens 10 zeichen haben'
                return false
            }
            else if(this.passwort !== this.passwortW)
            {
                document.getElementById('hiddenErrorPasswort').innerText = 'die passwörter müssen übereinstimmen'
                return false
            }
            else
            {
                document.getElementById('hiddenErrorPasswort').innerText = ''
                return true
            }
        }


        formUeberpruefung = ()=>
        {
            const vorname = vornamePruefung()
            const nachname = nachnamePruefung()
            const email = emailPruefung()
            const alter = alterPruefung()
            const passwort = passwortPruefung()
            return vorname && nachname && email && alter && passwort ? true : false;
        }

        if(formUeberpruefung())
        {
            const form = document.getElementById('registrierenForm')
            form.submit()
        }



    })