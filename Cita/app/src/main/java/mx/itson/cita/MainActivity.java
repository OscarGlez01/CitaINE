package mx.itson.cita;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity implements View.OnClickListener{

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

    }
}