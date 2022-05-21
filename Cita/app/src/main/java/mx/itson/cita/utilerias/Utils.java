package mx.itson.cita.utilerias;

import mx.itson.cita.interfaces.ApiService;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class Utils {

    public static ApiService getApi(){
        Retrofit retrofit = new Retrofit.Builder().baseUrl("http://192.168.1.94/apicita/public/api/").addConverterFactory(GsonConverterFactory.create()).build();
        return  retrofit.create(ApiService.class);
    }
}
