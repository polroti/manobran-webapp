<%@ page import="java.sql.Connection" %>
<%@ page import="java.sql.DriverManager" %>
<%@ page import="java.sql.Statement" %>
<%@ page import="java.sql.ResultSet" %><%--
  Created by IntelliJ IDEA.
  User: Manoj Kumar
  Date: 03-Feb-19
  Time: 2:05 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Hello Amasi</title>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
    </tr>
<%
    try {
       Class.forName("com.mysql.jdbc.Driver");
        Connection connection= DriverManager.getConnection("jdbc:mysql://35.240.137.14:3306/manobran_core","root","root");
        Statement statement=connection.createStatement();
        ResultSet resultSet=statement.executeQuery("SELECT  * FROM  dummy_table");
        while (resultSet.next()){
            %>

<tr>
    <td>
        <%=resultSet.getString("id")%>
    </td>
    <td>
        <%=resultSet.getString("name")%>
    </td>
    <td>
        <%=resultSet.getString("age")%>
    </td>
</tr>

<%


        }
        statement.executeUpdate("DELETE from dummy_table where id = 3");
        connection.close();
    }catch (Exception e){
        e.printStackTrace();
    }

%>
</table>
</body>
</html>
