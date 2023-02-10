package com.ifp.calculator;
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

/**
 *
 * @author Luis Varona, DAW 1º - iFP
 */
import java.awt.event.*;
import javax.swing.*;
import java.awt.*;

class Calculadora extends JFrame implements ActionListener {
    //creamos la ventana
    static JFrame ventana;
    
    //creamos el textfield
    static JTextField result;
    
    //variables para el operando, num1 y num2
    String n1, operando, n2;
    
    //iniciamos las variables, sin ningún valor. para tener el JTextField en blanco
    Calculadora()
    {
        n1 = operando = n2 = "";
    }
    
    //funcion MAIN
    public static void main(String args[])
    {
        //crear la ventana
        ventana = new JFrame("Calculadora");
        try {
            UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName()); 
        }
        catch (Exception e) {
            System.err.println(e.getMessage());
        }
        //objeto de clase, calculadora
        Calculadora c = new Calculadora();
        //crear TextField, no Editable
        result = new JTextField(15);
        result.setEditable(false);
        
        //creamos los botones
        //botones números
        JButton cero = new JButton("0");
        JButton uno = new JButton("1");
        JButton dos = new JButton("2");
        JButton tres = new JButton("3");
        JButton cuatro = new JButton("4");
        JButton cinco = new JButton("5");
        JButton seis = new JButton("6");
        JButton siete = new JButton("7");
        JButton ocho = new JButton("8");
        JButton nueve = new JButton("9");
        
        //botones especiales
        JButton igual = new JButton("=");
        JButton punto = new JButton(".");
        JButton C = new JButton("C");
        
        //botones operandos
        JButton suma = new JButton("+");
        JButton resta = new JButton("-");
        JButton producto = new JButton("*");
        JButton division = new JButton("/");
        JButton factorial = new JButton("!");
        JButton raiz = new JButton("√");
        JButton potencia = new JButton("^");
        JButton seno = new JButton("sen");
        JButton coseno = new JButton("cos");
        JButton tangente = new JButton("tan");
        JButton arcoseno = new JButton("arcsen");
        JButton arcocoseno = new JButton("arccos");
        JButton mayor = new JButton("M");
        JButton menor = new JButton("m");
        
        //creamos los paneles
        JPanel p1 = new JPanel();
        JPanel p2 = new JPanel();
        GridLayout botones = new GridLayout(5,5);
        p2.setLayout(botones);
        
        //añadimos el actionListener a los botones
        cero.addActionListener(c);
        uno.addActionListener(c);
        dos.addActionListener(c);
        tres.addActionListener(c);
        cuatro.addActionListener(c);
        cinco.addActionListener(c);
        seis.addActionListener(c);
        siete.addActionListener(c);
        ocho.addActionListener(c);
        nueve.addActionListener(c);
        punto.addActionListener(c);
        suma.addActionListener(c);
        resta.addActionListener(c);
        producto.addActionListener(c);
        division.addActionListener(c);
        igual.addActionListener(c);
        C.addActionListener(c);
        factorial.addActionListener(c);
        raiz.addActionListener(c);
        potencia.addActionListener(c);
        seno.addActionListener(c);
        coseno.addActionListener(c);
        tangente.addActionListener(c);
        arcoseno.addActionListener(c);
        arcocoseno.addActionListener(c);
        mayor.addActionListener(c);
        menor.addActionListener(c);
        
        //añadimos elementos, panel 1
        p1.add(C);
        p1.add(igual);
        p1.add(result);
        
        //añadimos elementos, panel 2
        p2.add(seno);
        p2.add(coseno);
        p2.add(tangente);
        p2.add(arcoseno);
        p2.add(arcocoseno);
        p2.add(suma);
        p2.add(resta);
        p2.add(producto);
        p2.add(division);
        p2.add(mayor);
        p2.add(factorial);
        p2.add(siete);
        p2.add(ocho);
        p2.add(nueve);
        p2.add(menor);
        p2.add(punto);
        p2.add(cuatro);
        p2.add(cinco);
        p2.add(seis);
        p2.add(raiz);
        p2.add(cero);
        p2.add(uno);
        p2.add(dos);
        p2.add(tres);
        p2.add(potencia);
        
        //color de fondo para los paneles
        p1.setBackground(Color.gray);
        p2.setBackground(Color.gray);
        
        //añadir paneles a la ventana (JFrame)
        ventana.getContentPane().add(BorderLayout.NORTH, p1);
        ventana.getContentPane().add(BorderLayout.CENTER, p2);
        ventana.setSize(350, 320);
        ventana.setResizable(false);
        ventana.setVisible(true);
        ventana.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        ventana.setUndecorated(true);
                
    }
    
    //inicia el ActionPerformed, UNO para todos los botones. utilizamos 'if' para diferenciar los botones pulsados
    @Override
    public void actionPerformed(ActionEvent e)
    {
        String n = e.getActionCommand();
        //introducir números
        if ((n.charAt(0) >= '0' && n.charAt(0) <='9') || n.charAt(0) == '.'){
            //comprobar si introduce operando
            if(!operando.equals("")){
                //no permitir dos 0s
                if(n2.equals("0") && n.charAt(0) != '.')
                    n2 = n;
                    //si añade un punto, poner 0.
                    else 
                        if(n2.equals("") && n.charAt(0) == '.')
                            n2 = "0" + n;
                        //no permitir dos puntos
                        else if(!(n2.contains(".") && n.charAt(0) == '.'))
                            n2 += n;       
            }
            else{
                 //no permitir dos 0s
                if(n1.equals("0") && n.charAt(0) != '.')
                    n1 = n;
                    //si añade un punto, poner 0.
                    else 
                        if(n1.equals("") && n.charAt(0) == '.')
                            n1 = "0" + n;
                        //no permitir dos puntos
                        else if(!(n1.contains(".") && n.charAt(0) == '.'))
                            n1 += n;
            }
                   //mostrar el valor
            result.setText(n1 + operando + n2);
        }
        else if (n.charAt(0) == 'C'){         
            //mostrar valor
            n1 = operando = n2 = "";
            result.setText(null);
        }
        else if (n.charAt(0) == '='){
            //definir variable para resultado
            double resultado = 0;
            
            //BLOQUE 1
            //comprobar que operando se pulsa
            if(operando.equals("+")) //suma
                resultado = (Double.parseDouble(n1) + Double.parseDouble(n2));          
            else if(operando.equals("-")) //resta
                resultado = (Double.parseDouble(n1) - Double.parseDouble(n2));        
            else if(operando.equals("/")) //division
                //comprobamos que el denominador sea distinto de 0
                if(n2.equals("0")){
                    result.setText(n1 + operando + n2 + "=" + "Infinito");
                    n1 = operando = n2 = "";
                    return;
                }   
                else
                    resultado = (Double.parseDouble(n1) / Double.parseDouble(n2));
            else if(operando.equals("^")) //elevado a
                resultado = Math.pow(Double.parseDouble(n1), Double.parseDouble(n2));
            else if(operando.equals("√")) //raiz cuadrada
                if((!n2.equals("") && !n1.equals(""))) //en el caso de dar n√m
                    resultado = (Double.parseDouble(n1) * (Math.sqrt(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals(""))) //funciona como n√
                        resultado = Math.sqrt(Double.parseDouble(n1));
                        else  //funciona tambien como √n
                            resultado = Math.sqrt(Double.parseDouble(n2));
            else if(operando.equals("m")) //menor número
                if((Double.parseDouble(n1))<(Double.parseDouble(n2)))
                    resultado = (Double.parseDouble(n1));
                else
                    resultado = (Double.parseDouble(n2)); 
            else if(operando.equals("M")) //mayor número
                if((Double.parseDouble(n1))>(Double.parseDouble(n2)))
                    resultado = (Double.parseDouble(n1));               
                else
                    resultado = (Double.parseDouble(n2));
            else if(operando.equals("arccos")) //arcocoseno
                if((!n2.equals("") && !n1.equals(""))) //contemplamos el caso n arccos m
                    resultado = (Double.parseDouble(n1) * (Math.acos(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.acos(Double.parseDouble(n1));
                        else
                            resultado = Math.acos(Double.parseDouble(n2));
            else if(operando.equals("arcsen")) //arcoseno
                if((!n2.equals("") && !n1.equals(""))) //contemplamos el caso n arcsen m
                    resultado = (Double.parseDouble(n1) * (Math.asin(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.asin(Double.parseDouble(n1));
                        else
                            resultado = Math.asin(Double.parseDouble(n2));
            else if(operando.equals("tan")) //tangente
                if((!n2.equals("") && !n1.equals(""))) //contemplamos el caso n tan m
                    resultado = (Double.parseDouble(n1) * (Math.tan(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.tan(Double.parseDouble(n1));
                        else
                            resultado = Math.tan(Double.parseDouble(n2));
            else if(operando.equals("cos")) //coseno
                if((!n2.equals("") && !n1.equals(""))) //contemplamos el caso n cos m
                    resultado = (Double.parseDouble(n1) * (Math.cos(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.cos(Double.parseDouble(n1));
                        else
                            resultado = Math.cos(Double.parseDouble(n2));
            else if(operando.equals("sen")) //sen
                if((!n2.equals("") && !n1.equals(""))) //contemplamos el caso n sen m
                    resultado = (Double.parseDouble(n1) * (Math.sin(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.sin(Double.parseDouble(n1));   
                        else
                            resultado = Math.sin(Double.parseDouble(n2));
            else if(operando.equals("!")) //factorial
                if((!n2.equals("") && !n1.equals(""))){ //contemplamos el caso n!m
                    double factorial;
                    double numero ;
                    numero = Double.parseDouble(n1);
                    factorial = 1;
                    while (numero!=0){
                        factorial = factorial*numero; 
                        numero--;                        
                    }
                    resultado = (Double.parseDouble(n2)) * factorial;
                }
                    else if(n2.equals("") && (!n1.equals(""))){
                        double factorial;
                        double numero ;
                        numero = Double.parseDouble(n1);
                        factorial = 1;
                        while (numero!=0){
                            factorial = factorial*numero; 
                            numero--;                        
                        }
                        resultado = factorial;
                    }
                        else //solo funciona el factorial, de la forma n! y no !n
                            resultado = 0;
            //si no es ninguno de los anteriores operandos, es producto            
            else
                resultado = (Double.parseDouble(n1) * Double.parseDouble(n2));
            
            //redondeo a 2 decimales
            resultado = Math.round(resultado*1000.0)/1000.0;
                
            //mostrar resultado
            result.setText(n1 + operando + n2 + "=" + resultado);
            
            //convertimos a string
            n1 = Double.toString(resultado);
            
            operando = n2 = "";
        }
        //para cuando pulsa OTRO operando más, en vez del igual. similar al de arriba
        //BLOQUE 2 = BLOQUE 1
        else {
            //no hay operando
            if(operando.equals("") || n2.equals(""))
                operando = n;
            //si no, evaluar
            else {
                double resultado = 0;
                if(operando.equals("+"))
                resultado = (Double.parseDouble(n1) + Double.parseDouble(n2));          
            else if(operando.equals("-"))
                resultado = (Double.parseDouble(n1) - Double.parseDouble(n2));        
            else if(operando.equals("/"))
                if(n2.equals("0")){
                    result.setText(n1 + operando + n2 + "=" + "Infinity");
                    n1 = operando = n2 = "";
                    return;
                }   
                else
                    resultado = (Double.parseDouble(n1) / Double.parseDouble(n2));
            else if(operando.equals("^"))
                resultado = Math.pow(Double.parseDouble(n1), Double.parseDouble(n2));
            else if(operando.equals("√"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.sqrt(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.sqrt(Double.parseDouble(n1));
                        else
                            resultado = Math.sqrt(Double.parseDouble(n2));
            else if(operando.equals("m"))
                if((Double.parseDouble(n1))<(Double.parseDouble(n2)))
                    resultado = (Double.parseDouble(n1));
                else
                    resultado = (Double.parseDouble(n2)); 
            else if(operando.equals("M"))
                if((Double.parseDouble(n1))>(Double.parseDouble(n2)))
                    resultado = (Double.parseDouble(n1));               
                else
                    resultado = (Double.parseDouble(n2));
            else if(operando.equals("arccos"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.acos(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.acos(Double.parseDouble(n1));
                        else
                            resultado = Math.acos(Double.parseDouble(n2));
            else if(operando.equals("arcsen"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.asin(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.asin(Double.parseDouble(n1));
                        else
                            resultado = Math.asin(Double.parseDouble(n2));
            else if(operando.equals("tan"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.tan(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.tan(Double.parseDouble(n1));
                        else
                            resultado = Math.tan(Double.parseDouble(n2));
            else if(operando.equals("cos"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.cos(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.cos(Double.parseDouble(n1));
                        else
                            resultado = Math.cos(Double.parseDouble(n2));
            else if(operando.equals("sen"))
                if((!n2.equals("") && !n1.equals("")))
                    resultado = (Double.parseDouble(n1) * (Math.sin(Double.parseDouble(n2))));
                    else if(n2.equals("") && (!n1.equals("")))
                        resultado = Math.sin(Double.parseDouble(n1));   
                        else
                            resultado = Math.sin(Double.parseDouble(n2));
            else if(operando.equals("!"))
                if((!n2.equals("") && !n1.equals(""))){
                    double factorial;
                    double numero ;
                    numero = Double.parseDouble(n1);
                    factorial = 1;
                    while (numero!=0){
                        factorial = factorial*numero; 
                        numero--;                        
                    }
                    resultado = (Double.parseDouble(n2)) * factorial;
                }
                    else if(n2.equals("") && (!n1.equals(""))){
                        double factorial;
                        double numero ;
                        numero = Double.parseDouble(n1);
                        factorial = 1;
                        while (numero!=0){
                            factorial = factorial*numero; 
                            numero--;                        
                        }
                        resultado = factorial;
                    }
                        else
                            resultado = 0;          
            else
                resultado = (Double.parseDouble(n1) * Double.parseDouble(n2));
                
                resultado = Math.round(resultado*1000.0)/1000.0;
                
                n1 = Double.toString(resultado);
                operando = n;
                n2 = "";
            }
            
            //mostrar total
            result.setText(n1 + operando + n2);
            
        }
    }
}
