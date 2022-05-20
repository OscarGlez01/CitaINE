package mx.itson.cita;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import mx.itson.cita.entidades.Cita;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    Button btn_agendar;
    Button btn_consultar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btn_agendar = findViewById(R.id.btn_agendar);
        btn_agendar.setOnClickListener(this);

        btn_consultar = findViewById(R.id.btn_consultar);
        btn_consultar.setOnClickListener(this);

    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btn_agendar:

                Cita cita = new Cita();
                Intent intentEditar = new Intent(this, CitaFormActivity.class);
                intentEditar.putExtra("cita", cita);
                startActivity(intentEditar);
                break;

            case R.id.btn_consultar:
                Intent intentConsultar = new Intent(MainActivity.this, CitaListActivity.class);
                startActivity(intentConsultar);
                break;
        }
    }
}