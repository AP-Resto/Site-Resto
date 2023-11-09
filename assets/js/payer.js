function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(/\d{4,15}/g);
    var match = matches && matches[0] || ''
    var parts = []

    for (i=0, len=match.length; i<len; i+=4) {
        parts.push(match.substring(i, i+4))
    }

    if (parts.length) {
        return parts.join(' ')
    } else {
        return value
    }
}
document.getElementById('carte_bancaire').addEventListener('keypress', (event) => {
    let numeroActuel = event.target.value;
    let numeroFormatter = cc_format(numeroActuel);

    document.getElementById("carte_bancaire").value = numeroFormatter;
    
});