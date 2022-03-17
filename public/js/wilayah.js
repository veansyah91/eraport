function token() {
    return null;
}

function funcprovinsi(t) {
    return fetch(`/api/provinces`)
        .then(response => response.json())
        .then(response => response.data)
}

function funckabupaten(token1, provinsi) {
    return fetch(`/api/regencies?province=${provinsi}`)
        .then(response => response.json())
        // .then(response => response.data)
}

function funckecamatan(token1, kabupaten) {
    return fetch(`/api/districts?regency=${kabupaten}`)
        .then(response => response.json())
        // .then(response => response.data)
}

function funcdesa(token1, kecamatan) {
    return fetch(`/api/villages?district=${kecamatan}`)
        .then(response => response.json())
        // .then(response => response.data)
}
