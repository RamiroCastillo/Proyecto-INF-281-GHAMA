<?php
/**
 * Clase para validar un formulario
 */

class Validar
{
    /**
     * Validar constructor.
     */
    public function __construct()
    {

    }

    /**
     * Verifica si existe el array $_POST
     * @param $variable
     * @return bool
     */
    public function validarSiExisteLaVariablePOST($variable)
    {
        if (isset($variable)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica si existe el campo enviado del formulario
     * @param $campo
     * @return mixed
     * @throws Exception
     */
    public function validarSiExisteElCampo($campo)
    {
        if (isset($campo)) {
            return $campo;
        } else {
            throw new Exception('No existe el campo' . $campo);
        }
    }

    /**
     * trim - Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
     * @param $campo
     * @return string
     */
    public function validarEspacios($campo)
    {
        $campo = trim($campo);
        return $campo;
    }

    /**
     * empty — Determina si una variable está vacía
     * @param $campo
     * @return string
     */
    public function validarTexto($campo)
    {
        if (empty($campo)) {
            throw new Exception('La cadena ' . $campo . ' esta vacia');
        } else {
            return $campo;
        }
    }
    /**
    /**
     * strip_tags — Retira las etiquetas HTML y PHP de un string
     * @param $campo
     * @return string
     */
    public function validarEtiquetasHTMLPHP($campo)
    {
        $campo = strip_tags($campo);
        return $campo;
    }

    /**
     * filter_var — Filtra una variable con el filtro que se indique
     * @param $campo
     * @return string
     */
    public function validarEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            throw new Exception('El Email ' . $email . ' es incorrecto');
        }
    }

    /**
     * filter_var — Filtra una variable con el filtro que se indique
     * @param $campo
     * @return string
     */
    public function validarInteger($number)
    {
        if (filter_var($number, FILTER_VALIDATE_INT)) {
            return $number;
        } else {
            throw new Exception('El Valor ' . $number . ' no es un numero');
        }
    }

    /**
     * Validacion de campos de formulario
     * @param $campo
     * @return mixed|string
     * @throws Exception
     */
    public function filterForm($campo)
    {
        $campo = $this->validarSiExisteElCampo($campo);
        $campo = $this->validarEspacios($campo);
        $campo = $this->validarTexto($campo);
        $campo = $this->validarEtiquetasHTMLPHP($campo);

        return $campo;
    }
    public function ValidaPassword($campo1, $campo2)
    {
        if ($campo1 = $campo2) {
            return $campo1;
        }else{
            throw new Exception('La Contraseña no coincide');
        }

    }
}
