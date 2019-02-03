package connection.cloud.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class cloud_db_connection {
   private String databaseName="manobran-db";
   private String instanceConnectionName="manobran-db";
   private String username="root";
    private String password="root";
   private String jdbcUrl = String.format(
            "jdbc:mysql://google/%s?cloudSqlInstance=%s"
                    + "&socketFactory=com.google.cloud.sql.mysql.SocketFactory&useSSL=false",
            databaseName,
            instanceConnectionName);

    {
        try {
            Connection connection = DriverManager.getConnection(jdbcUrl, username, password);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
