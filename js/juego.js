var app = new Vue({
    el: "#app",
    delimiters: ["{(", ")}"],
    data: {
        juego_html: "",
        cursoid: 0,
        puntaje: 0,
    },
    created() {
        this.getJuego();
    },
    methods: {
        juegoFinalizado: function () {
            let frm = new FormData();
            frm.append("request_type", "actualizarEstadoJuegoByUser");
            frm.append("cursoid", this.cursoid);
            frm.append("puntaje", this.puntaje);
            frm.append("sesskey", sesskey);
            axios.post("api/ajax_controller.php", frm).then((res) => {});
        },
        getJuego: function () {
            let headersList = {
                Accept: "*/*",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Methods": "GET",
                "Access-Control-Allow-Headers": "Content-Type, Authorization",
            };

            let reqOptions = {
                url: "https://daktico.com/",
                method: "GET",
                headers: headersList,
            };

            axios.request(reqOptions).then(function (res) {
                console.log(res.data);
            });
        },
    },
});
