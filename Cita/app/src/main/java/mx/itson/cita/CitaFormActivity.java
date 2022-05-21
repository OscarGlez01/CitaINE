package mx.itson.cita;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import mx.itson.cita.entidades.Cita;
import mx.itson.cita.entidades.Modulo;
import mx.itson.cita.entidades.Tramite;
import mx.itson.cita.transporte.RespuestaDTO;
import mx.itson.cita.utilerias.Utils;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CitaFormActivity extends AppCompatActivity implements View.OnClickListener{

    Button btnGuardar;
    EditText txtFolio;
    EditText txtCiudadano;
    EditText txtDocumento;
    EditText txtFecha;
    EditText txtComprobante;
    Spinner spnModulo;
    Spinner spnTramite;
    EditText txtEstado;


    Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cita_form);
        context = CitaFormActivity.this;

        Intent intentCrear = getIntent();
        Cita cita = (Cita) intentCrear.getSerializableExtra("cita");

        txtFolio = (EditText) findViewById(R.id.txtFolio);
        txtCiudadano = (EditText) findViewById(R.id.txtCiudadano);
        txtFecha = (EditText) findViewById(R.id.txtFecha);
        txtDocumento = (EditText) findViewById(R.id.txtDocumento);
        txtComprobante = (EditText) findViewById(R.id.txtComprobante);
        spnModulo = (Spinner) findViewById(R.id.spnModulo);
        spnTramite = (Spinner) findViewById(R.id.spnTramite);
        btnGuardar = (Button) findViewById(R.id.btnGuardar);
        btnGuardar.setOnClickListener(this);

        cargarModulos();



    }

    public void cargarModulos(){
        Call<List<Modulo>> call = Utils.getApi().getModulos();
        call.enqueue(new Callback<List<Modulo>>() {
            @Override
            public void onResponse(Call<List<Modulo>> call, Response<List<Modulo>> response) {
                List<Modulo> modulos = response.body();
                ArrayAdapter<Modulo> adapter = new ArrayAdapter<Modulo>(context, androidx.appcompat.R.layout.support_simple_spinner_dropdown_item, modulos);
                spnModulo.setAdapter(adapter);
            }

            @Override
            public void onFailure(Call<List<Modulo>> call, Throwable t) {

            }
        });
    }

    @Override
    public void onClick(View view) {
        switch (view.getId()){
            case R.id.btnGuardar:
                Modulo modulo = (Modulo) spnModulo.getSelectedItem();
                Tramite tramite = (Tramite) spnModulo.getSelectedItem();
                int folio;
                Date fecha=new Date();
                SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
                Call<RespuestaDTO> call = Utils.getApi().guardar(
                        folio=Integer.parseInt(txtFolio.getText().toString()),
                        txtCiudadano.getText().toString(),
                        fecha,
                        txtDocumento.getText().toString(),
                        txtComprobante.getText().toString(),
                        modulo.getId(),
                        tramite.getId(),
                        txtEstado.getText().toString()
                );
                call.enqueue(new Callback<RespuestaDTO>() {
                    @Override
                    public void onResponse(Call<RespuestaDTO> call, Response<RespuestaDTO> response) {
                        RespuestaDTO respuestaDTO = response.body();
                        Toast.makeText(CitaFormActivity.this, respuestaDTO.getMensaje(), Toast.LENGTH_SHORT).show();
                    }

                    @Override
                    public void onFailure(Call<RespuestaDTO> call, Throwable t) {

                    }
                });
                break;
        }
    }
}