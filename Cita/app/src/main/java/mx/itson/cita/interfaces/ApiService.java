package mx.itson.cita.interfaces;

import java.util.Date;
import java.util.List;

import mx.itson.cita.entidades.Cita;
import mx.itson.cita.entidades.Modulo;
import mx.itson.cita.entidades.Tramite;
import mx.itson.cita.transporte.RespuestaDTO;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;

public interface ApiService {

    @GET("citas")
    Call<List<Cita>> getCitas();

    @GET("modulos")
    Call<List<Modulo>> getModulos();

    @GET("tramites")
    Call<List<Tramite>> getTramites();

    @Headers("Content-Type: application/x-www-form-urlencoded")
    @POST("citas/guardar")
    Call<RespuestaDTO> guardar(
            @Field("folio") int folio,
            @Field("ciudadano") String ciudadano,
            @Field("fecha") Date fecha,
            @Field("documento") String documento,
            @Field("comprobante") String comprobante,
            @Field("idModulo") int idModulo,
            @Field("idTramite") int idTramite,
            @Field("estado") String estado
    );




}
