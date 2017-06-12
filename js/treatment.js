function surligne(champ, erreur)
{
    if(erreur)
    {
        champ.style.backgroundColor='#FFEAEA';
    champ.style.color='#000000';
    }
    else
    {
        champ.style.backgroundColor='';
        champ.style.color='';
    }
}
function verifText(champ)
{
    if(champ.value=='')
    {
        surligne(champ,true);
        return false;
    }
    else
    {
		surligne(champ,false);
        return true;
    }
}
function antiInjec(champ)
{
    if (champ.value.includes("{") || champ.value.includes("/") || champ.value.includes("\\") || champ.value.includes("#") ||
        champ.value.includes("(") || champ.value.includes("[") || champ.value.includes("$") || champ.value.includes(";") ||
        champ.value.includes(">") || champ.value.includes("<") || champ.value.includes("*") || champ.value.includes("%"))
    {
        return false;
    }
    else 
    {
        return true;
    }
}
function verifPass(champ1,champ2)
{
    if(champ1.value == champ2.value && champ1.value!='' && champ2.value!='') {
        return true;
    }
    else
        return false;
    }
function verifMail(champ)
{
    if (champ.value.includes("@uha.fr"))
    {
        return true;
    }
    else 
    {
        return false;
    }
}
function verifForm(f)
{
    var email_noInjec = antiInjec(f.email);
    var pass_noInjec = antiInjec(f.password);
    var repass_noInjec = antiInjec(f.repassword);
    var firstname_noInjec = antiInjec(f.firstname);
    var lastname_noInjec = antiInjec(f.lastname);
    var address_noInjec = antiInjec(f.address);
    var zip_noInjec = antiInjec(f.zipcode);
    var town_noInjec = antiInjec(f.town);
    var birth_noInjec = antiInjec(f.birth);
    var phone_noInjec = antiInjec(f.phone);
    var email_Ok = verifText(f.email);
    var password_Ok = verifText(f.password);
    var repassword_Ok = verifText(f.repassword);
    var firstname_Ok = verifText(f.firstname);
    var lastname_Ok = verifText(f.lastname);
    var pass = f.password.value;
    var repass = f.repassword.value;
    if (email_noInjec && pass_noInjec && repass_noInjec && firstname_noInjec && lastname_noInjec && address_noInjec && zip_noInjec && town_noInjec
            && birth_noInjec && phone_noInjec)
    {
        if(email_Ok && password_Ok && repassword_Ok && firstname_Ok && lastname_Ok)
        {
            if (verifPass(f.password,f.repassword))
            {
                if (verifMail(f.email))
                {
                    return true;
                }
                else 
                {
                    alert("Ce n'est pas une adresse mail UHA");
                    return false;
                }
            }
            else
            {
                alert("Vos mots de passe ne sont pas similaires");
                f.repassword.style.backgroundColor='#FFEAEA';
                f.repassword.style.color='#000000';
                return false;
            }
        }
        else
        {
            alert("Merci de bien vouloir remplir tous les champs en rose");
            return false;
        }
    }
    else
    {
        alert("Caractères non autorisés utilisés");
        return false;
    }
}