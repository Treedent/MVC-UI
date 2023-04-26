const AesJson = {
    /***
     * Encripte une valeur quelconque
     * @param {*} value
     * @param {string} password
     * @return {string}
     ***/
    'encrypt': function (value, password) {
        return CryptoJS.AES.encrypt(JSON.stringify(value), password, { format: AesJson }).toString();
    },
    /***
     * Decripte une valeur préalablement encriptée
     * @param {string} jsonStr
     * @param {string} password
     * @return {*}
     ***/
    'decrypt': function (jsonStr, password) {
        return JSON.parse(CryptoJS.AES.decrypt(jsonStr, password, { format: AesJson }).toString(CryptoJS.enc.Utf8));
    },
    /***
     * Stringifie une connée cryptoJS
     * @param {Object} cipherParams
     * @return {string}
     ***/
    'stringify': function (cipherParams) {
        let j = { ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64) }
        if (cipherParams.iv) j.iv = cipherParams.iv.toString()
        if (cipherParams.salt) j.s = cipherParams.salt.toString()
        return JSON.stringify(j).replace(/\s/g, '')
    },
    /***
     * Parse une donnée cryptoJS
     * @param {string} jsonStr
     * @return {*}
     ***/
    'parse': function (jsonStr) {
        let j = JSON.parse(jsonStr);
        let cipherParams = CryptoJS.lib.CipherParams.create({ ciphertext: CryptoJS.enc.Base64.parse(j.ct) });
        if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv);
        if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s);
        return cipherParams;
    }
}