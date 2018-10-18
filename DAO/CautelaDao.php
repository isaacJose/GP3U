<?php

class CautelaDao {
    function adiciona(conexao $conn, Cautela $cautela) {
          
        $query = "";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //ok
    function recuperaId(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                return $id;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaPolicial(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $policial = $row['policial'];
                return $policial;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaArmamento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $armamento = $row['armamento'];
                return $armamento;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaQuantidade(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $quantidade = $row['quantidade'];
                return $quantidade;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaTipo_cautela(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $tipo_cautela = $row['tipo_cautela'];
                return $tipo_cautela;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaVencimento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $vencimento = $row['vencimento'];
                return $vencimento;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function exclui(conexao $conn, Cautela $cautela) {
        $query = "DELETE FROM cautela WHERE id = '{$cautela->getId()}'";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //done
    function edita(conexao $conn, Cautela $cautela) {
        $query = "";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    function lista(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["policial"] . '</td>';
                echo '<td>' . $row["armamento,"] . '</td>';
                echo '<td>' . $row["quantidade"] . '</td>';
                echo '<td>' . $row["tipo_cautela"] . '</td>';
                echo '<td>' . $row["vencimento"] . '</td>';              
                echo '<td align="center"><input type="submit" name="editar1" value="Editar" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></td>';
                echo '<td align="center"><input type="submit" name="excluir" value="Excluir" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></td>';
                echo '</tr>';                
            }
        } else {
            echo "0 results";
        }
        
    }
}
