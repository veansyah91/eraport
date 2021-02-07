function token() {
    return fetch('https://x.rajaapi.com/poe')
        .then(response => response.json())
        .then(response => response.token)
}

function funcprovinsi(token1) {
    return fetch(`https://x.rajaapi.com/MeP7c5ne${token1}/m/wilayah/provinsi`)
        .then(response => response.json())
        .then(response => response.data)
}

function funckabupaten(token1, provinsi) {
    return fetch(`https://x.rajaapi.com/MeP7c5ne${token1}/m/wilayah/kabupaten?idpropinsi=${provinsi}`)
        .then(response => response.json())
        // .then(response => response.data)
}

function funckecamatan(token1, kabupaten) {
    return fetch(`https://x.rajaapi.com/MeP7c5ne${token1}/m/wilayah/kecamatan?idkabupaten=${kabupaten}`)
        .then(response => response.json())
        // .then(response => response.data)
}

function funcdesa(token1, kecamatan) {
    return fetch(`https://x.rajaapi.com/MeP7c5ne${token1}/m/wilayah/kelurahan?idkecamatan=${kecamatan}`)
        .then(response => response.json())
        // .then(response => response.data)
}
