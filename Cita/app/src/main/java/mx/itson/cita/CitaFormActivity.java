package mx.itson.cita;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import mx.itson.cita.entidades.Cita;

public class CitaFormActivity extends AppCompatActivity implements View.OnClickListener{

    Button btn_guardar;
    TextView txtFolio;

    Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cita_form);
        context = this;

        Intent intentCrear = getIntent();
        Cita cita = (Cita) intentCrear.getSerializableExtra("cita");

        txtFolio = findViewById(R.id.txtFolio);
        txtFolio.setText(cita.getFolio());

    }

    @Override
    public void onClick(View view) {

    }
}