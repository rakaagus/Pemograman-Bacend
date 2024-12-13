/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
const showDownload = (result) => {
    return new Promise((resolve) => {
        setTimeout(function () {
            console.log("Download selesai");
            resolve(`Hasil Download ${result}`)
        }, 3000);
    })
}

/**
   * Fungsi untuk download file
   * @param {function} callback - Function callback show
   */
const download = async () => {
    const result = "windows-10.exe";
    try {
        const mesage = await showDownload(result)
        console.log(mesage)
    } catch (error) {
        console.error(error)
    }
}

download();

/**
   * TODO:
   * - Refactor callback ke Promise atau Async Await
   * - Refactor function ke ES6 Arrow Function
   * - Refactor string ke ES6 Template Literals
   */