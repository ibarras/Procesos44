 new Vue({
        delimiters: ['{!', '!}'],
        el: '#crud-solicitud-reembolso',
        // el: '#data-solicitud-reembolso',

     created: function() {
             this.getSolicitudesReembolso();
         },
        data: {

            listSolicitudes: [],
            listSolicitud: [],
            list: [],
            listData: [],
            totales: [],
            id: null,
            FechaTransferencia: null,
            Torneo: null,
            TorneoCategoria: null,
            Jornada: null,
            CentroCosto: null,
            NumeroTarjeta: null,
            MotivoDeGasto: null,
            Informe: null,
            Importe: null,
            isHidden: false,
            isDataHidden: false,
            isFacturacionHidden: false,
            alimentos: null,
            facturado: null,
            presupuesto: null,
            real: null,
            total: null,

        },
        mounted(){
        },
        methods: {

            //
            // Peticion para una sola solicitud
            //

            getSolicitudReembolso: function(){
                const params = {
                    Id: this.id,
                };
                let url = '/api/solicitud-anticipo-reembolso/';

                axios.post(url, params).then(response => {
                    this.listSolicitud = response.data;
                    this.isHidden = true;
                    console.log(response.data);

                }).catch(error => {
                    this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                    console.log(error);
                });

            },

            //
            // Metodo para obtener todas las solicitudes de reembolso
            //

            getSolicitudesReembolso: function(){

                let url = '/api/solicitudes-de-anticipo-reembolso';

                axios.post(url).then(response => {
                    this.listSolicitudes = response.data;
                    this.isHidden = true;
                    console.log(response.data);

                }).catch(error => {
                    this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                    console.log(error);
                });

            },

            postSolicitudReembolso: function () {

                const params = {
                    FechaTransferencia: this.FechaTransferencia,
                    Torneo: this.Torneo,
                    TorneoCategoria: this.TorneoCategoria,
                    Jornada: this.Jornada,
                    CentroCosto: this.CentroCosto,
                    NumeroTarjeta: this.NumeroTarjeta,
                    MotivoDeGasto: this.MotivoDeGasto,
                    Informe: this.Informe,
                    Importe: this.Importe
                };

                var url = '/nueva-solicitudes-de-anticipo-reembolso';

                axios.post(url, params).then(response => {
                    this.list = response.data;
                    this.id = response.data[0]['Id'];

                    console.log(this.id);

                    this.isHidden = true;
                    this.isDataHidden = true;
                    console.log(response.data);
                    this.errors = [];
                }).catch(error => {
                    this.errors = 'Corrija para poder crear con éxito'
                    console.log(error);
                });
            },

            onClickDeleteSolicitud: function(solicitud){

                let url = '/api/eliminar-solicitud-anticipo-reembolso/' + solicitud.Id;

                axios.delete(url).then(response => {
                    this.getSolicitudesReembolso();
                    console.log(response.data);
                }).catch(error => {
                    this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                    console.log(error);
                });
            },

            onClickShowSolicitud: function(solicitud){

                let url = '/api/mostrar-solicitud-anticipo-reembolso/' + solicitud.Id;

                axios.get(url).then(response => {
                    this.listSolicitud = response.data.descripcion;
                    this.totales = response.forma.totales;
                    console.log(response.data);

                }).catch(error => {
                    this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                    console.log(error);
                });

            },



            //
            //Captura informacion de gastos de la solicitud
            //

            postCapturaGastos: function () {

                const params = {
                    Alimentos: this.alimentos,
                    Facturado: this.facturado,
                    Presupuesto: this.presupuesto,
                    Real: this.real,
                    Total: this.total,
                    Id: this.id,

                };

                var url = '/nueva-solicitudes-de-anticipo-reembolso-descripcion';

                axios.post(url, params).then(response => {
                    this.listData = response.data;
                    this.isFacturacionHidden = true;
                    console.log(response.data);
                    this.errors = [];
                }).catch(error => {
                    this.errors = 'Corrija para poder crear con éxito';
                    console.log(error);
                });
            }

        },
    })
;


