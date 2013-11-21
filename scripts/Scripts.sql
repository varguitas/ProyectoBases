USE Proyecto
GO
USE [master]
GO
CREATE LOGIN [adm_user] WITH PASSWORD=N'Bases123' MUST_CHANGE, DEFAULT_DATABASE=[master], CHECK_EXPIRATION=ON, CHECK_POLICY=ON
GO
USE [Proyecto]
GO
CREATE USER [adm_user] FOR LOGIN [adm_user]
GO
USE [master]
GO
CREATE LOGIN [app_user] WITH PASSWORD=N'Bases123' MUST_CHANGE, DEFAULT_DATABASE=[master], CHECK_EXPIRATION=ON, CHECK_POLICY=ON
GO
USE [Proyecto]
GO

CREATE USER [app_user] FOR LOGIN [app_user]
GO
USE Proyecto;
GO

-- GET ACT TORNEO
if object_id('get_act_torneo') is not null
begin
	DROP PROCEDURE get_act_torneo
end
GO
CREATE PROCEDURE get_act_torneo
AS BEGIN
	SELECT T.ID_TORNEO, T.NOMBRE
	FROM TORNEO T
	WHERE T.ESTADO_TORNEO = 'R' OR T.ESTADO_TORNEO = 'E'
END
GO
GRANT EXEC ON get_act_torneo TO app_user;
GO
GRANT EXEC ON get_act_torneo TO adm_user;
GO

-- ADD_PAIS
if object_id('add_pais') is not null
begin
	DROP PROCEDURE add_pais
end
GO
CREATE PROCEDURE add_pais @NOMBRE  varchar(100)
AS BEGIN
	INSERT INTO PAIS VALUES(@NOMBRE)
END
GRANT EXEC ON add_pais TO adm_user;
GO
-- ADD_UBICACION
if object_id('add_ubicacion') is not null
begin
	DROP PROCEDURE add_ubicacion
end
GO
CREATE PROCEDURE add_ubicacion
     @NOMBRE varchar(100),
     @DIRECCION varchar(100),
     @CONTACTO varchar(100),
     @TELEFONO varchar(10)
AS BEGIN
	INSERT INTO UBICACION
	VALUES(@NOMBRE,@DIRECCION,@CONTACTO,@TELEFONO)
END
GO
GRANT EXEC ON add_ubicacion TO adm_user;
GO

-- ADD_FORMATO
if object_id('add_formato') is not null
begin
	DROP PROCEDURE add_formato
end
GO
CREATE PROCEDURE add_formato
         @DESCRIPCION varchar(100)
AS BEGIN
	INSERT INTO FORMATO VALUES(@DESCRIPCION)
END
GO
GRANT EXEC ON add_formato TO adm_user;
GO

-- ADD_EQUIPO
if object_id('add_equipo') is not null
begin
	DROP PROCEDURE add_equipo
end
GO
CREATE PROCEDURE add_equipo 
     @ID_UBICACION int,
     @NOMBRE varchar(100),
     @FECHA_FUNDACION datetime,
     @HISTORIA varchar(100)=null
AS BEGIN
INSERT INTO EQUIPO VALUES(@ID_UBICACION, @NOMBRE, @FECHA_FUNDACION, @HISTORIA)
END
GO
GRANT EXEC ON add_equipo TO adm_user;
GO

-- ADD_ARBITRO
if object_id('add_arbitro') is not null
begin
	DROP PROCEDURE add_arbitro
end
GO
CREATE PROCEDURE add_arbitro 
@NOMBRE varchar(100), 
@APELLIDOS varchar(50), 
@FECHA_NACIMIENTO datetime, 
@TIPO_ARBITRO char(1)
AS BEGIN
INSERT INTO ARBITRO VALUES(@NOMBRE,@APELLIDOS,@FECHA_NACIMIENTO,@TIPO_ARBITRO)
END
GRANT EXEC ON add_arbitro TO adm_user;
GO

-- ADD_ARBITRO
if object_id('add_entrenador') is not null
begin
	DROP PROCEDURE add_entrenador
end
GO
CREATE PROCEDURE add_entrenador @ID_PAIS int, 
@NOMBRE varchar(100),
@APELLIDOS varchar(50),
@FECHA_NACIMIENTO datetime
AS BEGIN
INSERT INTO ENTRENADOR VALUES(@ID_PAIS,@NOMBRE, @APELLIDOS, @FECHA_NACIMIENTO)
END
GRANT EXEC ON add_entrenador TO adm_user;
GO

-- ADD_POSICION
if object_id('add_posicion') is not null
begin
	DROP PROCEDURE add_posicion
end
GO
CREATE PROCEDURE add_posicion @NOMBRE varchar(100)
AS BEGIN
INSERT INTO POSICION VALUES(@NOMBRE)
END
GO
GRANT EXEC ON add_posicion TO adm_user;
GO

-- ADD_JUGADOR
if object_id('add_jugador') is not null
begin
	DROP PROCEDURE add_jugador
end
GO
CREATE PROCEDURE add_jugador
    @ID_POSICION int,
    @ID_PAIS int,
    @NOMBRE varchar(100),
    @APELLIDOS varchar(50),
    @FECHA_NACIMIENTO datetime
AS BEGIN
INSERT INTO JUGADOR VALUES(@ID_POSICION, @ID_PAIS, @NOMBRE, @APELLIDOS, @FECHA_NACIMIENTO)
END
GRANT EXEC ON add_jugador TO adm_user;
GO






-- GET_UBICACIONES
if object_id('get_ubicaciones') is not null
begin
	DROP PROCEDURE get_ubicaciones
end
GO
CREATE PROCEDURE get_ubicaciones
AS BEGIN
	SELECT ID_UBICACION,NOMBRE
	FROM UBICACION
END
GO
GRANT EXEC ON get_ubicaciones TO adm_user;
GO

-- GET_PAISES
if object_id('get_paises') is not null
begin
	DROP PROCEDURE get_paises
end
GO
CREATE PROCEDURE get_paises
AS BEGIN
	SELECT ID_PAIS,NOMBRE
	FROM PAIS
END
GO
GRANT EXEC ON get_paises TO adm_user;
GO

-- GET_POSICIONES
if object_id('get_posiciones') is not null
begin
	DROP PROCEDURE get_posiciones
end
GO
CREATE PROCEDURE get_posiciones
AS BEGIN
	SELECT ID_POSICION,DESCRIPCION
	FROM POSICION
END
GO
GRANT EXEC ON get_posiciones TO adm_user;
GO

-- GET_FORMATOS
if object_id('get_formatos') is not null
begin
	DROP PROCEDURE get_formatos
end
GO
CREATE PROCEDURE get_formatos
AS BEGIN
	SELECT ID_FORMATO,DESCRIPCION
	FROM FORMATO
END
GO
GRANT EXEC ON get_formatos TO adm_user;
GO

-- ADD_TORNEO
if object_id('add_torneo') is not null
begin
	DROP PROCEDURE add_torneo
end
GO
CREATE PROCEDURE add_torneo
     @ID_FORMATO int,
     @ID_PAIS int,
     @NOMBRE varchar(100),
     @FECHA_INICIO datetime,
	 @FECHA_FIN datetime
AS BEGIN
INSERT INTO TORNEO VALUES(@ID_FORMATO, @ID_PAIS, @NOMBRE, @FECHA_INICIO, @FECHA_FIN, 'R')
END
GRANT EXEC ON add_torneo TO adm_user;
GO

-- GET_TORNEO INFO
if object_id('get_torneo_info') is not null
begin
	DROP PROCEDURE get_torneo_info
end
GO
CREATE PROCEDURE get_torneo_info @ID_TORNEO int
AS BEGIN
	SELECT t.ID_TORNEO,t.NOMBRE, DAY(t.FECHA_INICIO) AS dini, MONTH(t.FECHA_INICIO) AS mini, YEAR(t.FECHA_INICIO) AS yini, DAY(t.FECHA_FIN) AS dfin, MONTH(t.FECHA_FIN) AS mfin, YEAR(t.FECHA_FIN) AS yfin , p.NOMBRE AS pais, CONVERT(varchar,t.FECHA_INICIO) AS FECHA_INICIO
	FROM TORNEO t
	INNER JOIN PAIS p
	on (t.ID_PAIS=p.ID_PAIS)
	WHERE ID_TORNEO = @ID_TORNEO
END
GRANT EXEC ON get_torneo_info TO app_user;
GO
GRANT EXEC ON get_torneo_info TO adm_user;
GO

-- GET_EQUIPOS
if object_id('get_equipos') is not null
begin
	DROP PROCEDURE get_equipos
end
GO
CREATE PROCEDURE get_equipos AS
	BEGIN
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO
		ORDER BY NOMBRE ASC
	END
GO
GRANT EXEC ON get_equipos TO adm_user;
GO

--GET_EQUIPOS_INSCRITOS
if object_id('get_equipos_inscritos') is not null
begin
	DROP PROCEDURE get_equipos_inscritos
end
GO
CREATE PROCEDURE get_equipos_inscritos (@ID_TORNEO int) AS
	BEGIN
		SELECT i.ID_INSCRIPCION_EQUIPO, e.NOMBRE, CONVERT(varchar,i.FECHA_INSCRIPCION) AS FECHA_INSCRIPCION, t.NOMBRE as NOMBRE_TORNEO
		FROM (SELECT * FROM INSCRIPCION_EQUIPO WHERE ID_TORNEO=@ID_TORNEO) i
		INNER JOIN EQUIPO e
		ON i.ID_EQUIPO = e.ID_EQUIPO
		INNER JOIN TORNEO t
		ON i.ID_TORNEO = t.ID_TORNEO
		ORDER BY e.NOMBRE ASC
	END
GO
GRANT EXEC ON get_equipos_inscritos TO adm_user;
GO

--GET_EQUIPOS_NO_INSCRITOS
if object_id('get_equipos_no_inscritos') is not null
begin
	DROP PROCEDURE get_equipos_no_inscritos
end
GO
CREATE PROCEDURE get_equipos_no_inscritos (@ID_TORNEO int) AS
	BEGIN
		SELECT e.ID_EQUIPO, e.NOMBRE 
		FROM EQUIPO e
		WHERE e.ID_EQUIPO NOT IN(
			SELECT ID_EQUIPO
			FROM INSCRIPCION_EQUIPO
			WHERE ID_TORNEO=@ID_TORNEO
		)
		ORDER BY e.NOMBRE ASC
	END
GO
GRANT EXEC ON get_equipos_no_inscritos TO adm_user;
GO

--GET_JUGADORES
if object_id('get_jugadores') is not null
begin
	DROP PROCEDURE get_jugadores
end
GO
CREATE PROCEDURE get_jugadores AS
	BEGIN
		SELECT ID_JUGADOR, CONCAT(NOMBRE,' ',APELLIDOS) AS NOMBRE
		FROM JUGADOR
		ORDER BY NOMBRE ASC
	END
GO
GRANT EXEC ON get_jugadores TO adm_user;
GO

--GET_ENTRENADORES
if object_id('get_entrenadores') is not null
begin
	DROP PROCEDURE get_entrenadores
end
GO
CREATE PROCEDURE get_entrenadores AS
	BEGIN
		SELECT ID_ENTRENADOR, NOMBRE
		FROM ENTRENADOR
		ORDER BY NOMBRE ASC
	END
GO
GRANT EXEC ON get_entrenadores TO adm_user;
GO

if object_id('inscribir_equipo') is not null
begin
	DROP PROCEDURE inscribir_equipo
end
GO

--INSCRIBIR_EQUIPO
if object_id('inscribir_equipo') is not null
begin
	DROP PROCEDURE inscribir_equipo
end
GO
CREATE PROCEDURE inscribir_equipo(@ID_EQUIPO int, @ID_TORNEO int, @ID_ENTRENADOR int, @FECHA_CESE datetime = null, @IDS nvarchar(max))
AS BEGIN
	BEGIN TRANSACTION
		INSERT INTO INSCRIPCION_EQUIPO VALUES (@ID_EQUIPO,@ID_TORNEO,GETDATE())
		DECLARE @EQUIPO_INSCRITO int = (SELECT @@IDENTITY)
		INSERT INTO ENTRENADOR_EQUIPO VALUES (@ID_ENTRENADOR,@EQUIPO_INSCRITO, GETDATE(), @FECHA_CESE, 'A')
		INSERT INTO CLASIFICACION VALUES (@EQUIPO_INSCRITO, 0, 0, 0, 0, 0, 0, 0)
		DECLARE @xml_ids XML = @IDS
		CREATE TABLE #jugadores (
			ID_JUGADOR int,
			ID_POSICION int
		)
		INSERT INTO #jugadores
			SELECT C.value('(./jugador)[1]','int'),C.value('(./posicion)[1]','int')
			FROM @xml_ids.nodes('/ids/*') T(C)
		DECLARE c_jugadores CURSOR
		FOR
			SELECT *
			FROM #jugadores
		OPEN c_jugadores
		DECLARE @ID_JUGADOR int
		DECLARE @ID_POSICION int
		FETCH NEXT FROM c_jugadores INTO @ID_JUGADOR,@ID_POSICION
		WHILE @@FETCH_STATUS = 0
		BEGIN
			INSERT INTO INSCRIPCION_JUGADOR VALUES (@EQUIPO_INSCRITO,@ID_JUGADOR,@ID_POSICION,GETDATE(),null,'A')
			FETCH NEXT FROM c_jugadores INTO @ID_JUGADOR,@ID_POSICION
		END
		DEALLOCATE c_jugadores
		DROP TABLE #jugadores
		IF @@ERROR <> 0
		BEGIN
			ROLLBACK TRANSACTION
			RAISERROR('NO SE LOGRO',16,1)
		END
		ELSE
		BEGIN
			COMMIT TRANSACTION
		END
	END
GO
GRANT EXEC ON inscribir_equipo TO adm_user;
GO

-- GET_PROGRAMACION_TORNEO_HOY
if object_id('get_programacion_torneo_hoy') is not null
begin
	DROP PROCEDURE get_programacion_torneo_hoy
end
GO
CREATE PROCEDURE get_programacion_torneo_hoy @ID_TORNEO int
AS BEGIN
	SELECT pa.ID_PARTIDO,pa.ESTADO_PARTIDO,CONVERT(VARCHAR,CONVERT(DATE,pa.FECHA_PARTIDO)) AS FECHA,CONVERT(VARCHAR(5),CONVERT(TIME,pa.FECHA_PARTIDO),108) AS HORA,ec.NOMBRE as 'EQUIPO_CASA',pa.GOLES_CASA,ev.NOMBRE as 'EQUIPO_VISITA',pa.GOLES_VISITA
	FROM (
		SELECT ID_PARTIDO,ID_EQUIPO_CASA,ID_EQUIPO_VISITA,GOLES_CASA,GOLES_VISITA,FECHA_PARTIDO,ESTADO_PARTIDO
		FROM PARTIDO
		WHERE ID_TORNEO = @ID_TORNEO
		AND CONVERT(DATE,FECHA_PARTIDO) = CONVERT(DATE,GETDATE())
	) pa
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ec
	on (ec.ID_EQUIPO = pa.ID_EQUIPO_CASA)
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ev
	on (ev.ID_EQUIPO = pa.ID_EQUIPO_VISITA)
	ORDER BY pa.FECHA_PARTIDO desc
END
GO
GRANT EXEC ON get_programacion_torneo_hoy TO app_user;
GO

-- GET_PROGRAMACION_TORNEO_COMPLETADO
if object_id('get_programacion_torneo_completado') is not null
begin
	DROP PROCEDURE get_programacion_torneo_completado
end
GO
CREATE PROCEDURE get_programacion_torneo_completado @ID_TORNEO int
AS BEGIN
	SELECT pa.ID_PARTIDO,CONVERT(VARCHAR,CONVERT(DATE,pa.FECHA_PARTIDO)) AS FECHA,CONVERT(VARCHAR(5),CONVERT(TIME,pa.FECHA_PARTIDO),108) AS HORA,ec.NOMBRE as 'EQUIPO_CASA',pa.GOLES_CASA,ev.NOMBRE as 'EQUIPO_VISITA',pa.GOLES_VISITA
	FROM (
		SELECT ID_PARTIDO,ID_EQUIPO_CASA,ID_EQUIPO_VISITA,GOLES_CASA,GOLES_VISITA,FECHA_PARTIDO
		FROM PARTIDO
		WHERE ID_TORNEO = @ID_TORNEO
		AND ESTADO_PARTIDO = 'J'
	) pa
	inner join INSCRIPCION_EQUIPO ei
	on (pa.ID_EQUIPO_CASA = ei.ID_INSCRIPCION_EQUIPO )
	inner join 
	(SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ec
	on (ei.ID_EQUIPO = ec.ID_EQUIPO)
	inner join INSCRIPCION_EQUIPO eii
	on (pa.ID_EQUIPO_VISITA = eii.ID_INSCRIPCION_EQUIPO )
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ev
	on (eii.ID_EQUIPO = ev.ID_EQUIPO)
	ORDER BY pa.FECHA_PARTIDO asc
END
GO
GRANT EXEC ON get_programacion_torneo_completado TO app_user;
GO
GRANT EXEC ON get_programacion_torneo_completado TO adm_user;
GO

-- GET_PROGRAMACION_TORNEO_FUTURO
if object_id('get_programacion_torneo_futuro') is not null
begin
	DROP PROCEDURE get_programacion_torneo_futuro
end
GO
CREATE PROCEDURE get_programacion_torneo_futuro @ID_TORNEO int
AS BEGIN
	SELECT pa.ID_PARTIDO,CONVERT(VARCHAR,CONVERT(DATE,pa.FECHA_PARTIDO)) AS FECHA,CONVERT(VARCHAR(5),CONVERT(TIME,pa.FECHA_PARTIDO),108) AS HORA,ec.NOMBRE as 'EQUIPO_CASA',pa.GOLES_CASA,ev.NOMBRE as 'EQUIPO_VISITA',pa.GOLES_VISITA
	FROM (
		SELECT ID_PARTIDO,ID_EQUIPO_CASA,ID_EQUIPO_VISITA,GOLES_CASA,GOLES_VISITA,FECHA_PARTIDO
		FROM PARTIDO
		WHERE ID_TORNEO = @ID_TORNEO
		AND (ESTADO_PARTIDO = 'P' OR ESTADO_PARTIDO = 'R')
	) pa
	inner join INSCRIPCION_EQUIPO ei
	on (pa.ID_EQUIPO_CASA = ei.ID_INSCRIPCION_EQUIPO )
	inner join 
	(SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ec
	on (ei.ID_EQUIPO = ec.ID_EQUIPO)
	inner join INSCRIPCION_EQUIPO eii
	on (pa.ID_EQUIPO_VISITA = eii.ID_INSCRIPCION_EQUIPO )
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ev
	on (eii.ID_EQUIPO = ev.ID_EQUIPO)
	ORDER BY pa.FECHA_PARTIDO asc
END
GO
GRANT EXEC ON get_programacion_torneo_futuro TO app_user;
GO
GRANT EXEC ON get_programacion_torneo_futuro TO adm_user;
GO

-- GET_PARTIDO_INFO
if object_id('get_partido_info') is not null
begin
	DROP PROCEDURE get_partido_info
end
GO
CREATE PROCEDURE get_partido_info @ID_PARTIDO int
AS BEGIN
	SELECT pa.ID_PARTIDO,CONVERT(VARCHAR,CONVERT(DATE,pa.FECHA_PARTIDO)) AS FECHA,CONVERT(VARCHAR(5),CONVERT(TIME,pa.FECHA_PARTIDO),108) AS HORA,ec.ID_EQUIPO AS 'ID_EQUIPO_CASA',ec.NOMBRE as 'EQUIPO_CASA',pa.GOLES_CASA,ev.ID_EQUIPO AS 'ID_EQUIPO_VISITA',ev.NOMBRE as 'EQUIPO_VISITA',pa.GOLES_VISITA
	FROM (
		SELECT ID_PARTIDO,ID_EQUIPO_CASA,ID_EQUIPO_VISITA,GOLES_CASA,GOLES_VISITA,FECHA_PARTIDO
		FROM PARTIDO
		WHERE ID_PARTIDO = @ID_PARTIDO
	) pa
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ec
	on (ec.ID_EQUIPO = pa.ID_EQUIPO_CASA)
	inner join (
		SELECT ID_EQUIPO, NOMBRE
		FROM EQUIPO) ev
	on (ev.ID_EQUIPO = pa.ID_EQUIPO_VISITA)
END
GO
GRANT EXEC ON get_partido_info TO app_user;
GO
-- GET_PARTIDO_TARJETAS_CANTIDAD
if object_id('get_partido_tarjetas') is not null
begin
	DROP PROCEDURE get_partido_tarjetas
end
GO
CREATE PROCEDURE get_partido_tarjetas
@ID_EQUIPO_INSCRITO int,
@ID_PARTIDO int,
@COLOR VARCHAR(10)
AS BEGIN
	SELECT count(*) AS 'CANTIDAD'
	FROM (
		SELECT ID_INCIDENCIA,ID_ALINEACION
		FROM INCIDENCIA
		WHERE ID_PARTIDO = @ID_PARTIDO
	) inci
	inner join (
		SELECT * FROM
		TARJETA
		WHERE COLOR = @COLOR
	) tar
	on (tar.ID_INCIDENCIA = inci.ID_INCIDENCIA)
	inner join ALINEACION al
	on (inci.ID_ALINEACION=al.ID_ALINEACION)
	inner join (
		SELECT ID_INSCRIPCION_JUGADOR,ID_INSCRIPCION_EQUIPO
		FROM INSCRIPCION_JUGADOR
		WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_INSCRITO
	) ij
	on (al.ID_INSCRIPCION_JUGADOR = ij.ID_INSCRIPCION_JUGADOR)
END
GRANT EXEC ON get_partido_tarjetas TO app_user;
GO
-- GET_PARTIDO_TARJETAS_RESUMEN
if object_id('get_partido_tarjetas_resumen') is not null
begin
	DROP PROCEDURE get_partido_tarjetas_resumen
end
GO
CREATE PROCEDURE get_partido_tarjetas_resumen
@ID_EQUIPO_CASA int,
@ID_EQUIPO_VISITA int,
@ID_PARTIDO int
AS BEGIN
	SELECT *
	FROM (
		SELECT 1 AS 'NUMERO_EQUIPO',inci.MINUTO,tar.COLOR,CONCAT(ju.NOMBRE,' ',ju.APELLIDOS) AS 'NOMBRE'
		FROM (
			SELECT ID_INCIDENCIA,ID_ALINEACION,MINUTO
			FROM INCIDENCIA
			WHERE ID_PARTIDO = @ID_PARTIDO
		) inci
		inner join TARJETA tar
		on (tar.ID_INCIDENCIA = inci.ID_INCIDENCIA)
		inner join ALINEACION al
		on (inci.ID_ALINEACION=al.ID_ALINEACION)
		inner join (
			SELECT ID_INSCRIPCION_JUGADOR,ID_INSCRIPCION_EQUIPO,ID_JUGADOR
			FROM INSCRIPCION_JUGADOR
			WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_CASA
		) ij
		on (al.ID_INSCRIPCION_JUGADOR = ij.ID_INSCRIPCION_JUGADOR)
		inner join JUGADOR ju
		on (ij.ID_JUGADOR=ju.ID_JUGADOR)
		UNION
		SELECT 1 AS 'NUMERO_EQUIPO',inci.MINUTO,tar.COLOR,CONCAT(ju.NOMBRE,' ',ju.APELLIDOS) AS 'NOMBRE'
		FROM (
			SELECT ID_INCIDENCIA,ID_ALINEACION,MINUTO
			FROM INCIDENCIA
			WHERE ID_PARTIDO = @ID_PARTIDO
		) inci
		inner join TARJETA tar
		on (tar.ID_INCIDENCIA = inci.ID_INCIDENCIA)
		inner join ALINEACION al
		on (inci.ID_ALINEACION=al.ID_ALINEACION)
		inner join (
			SELECT ID_INSCRIPCION_JUGADOR,ID_INSCRIPCION_EQUIPO,ID_JUGADOR
			FROM INSCRIPCION_JUGADOR
			WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_VISITA
		) ij
		on (al.ID_INSCRIPCION_JUGADOR = ij.ID_INSCRIPCION_JUGADOR)
		inner join JUGADOR ju
		on (ij.ID_JUGADOR=ju.ID_JUGADOR)
	) AS re
	ORDER BY re.MINUTO
END
GRANT EXEC ON get_partido_tarjetas_resumen TO app_user;
GO

-- GET_PARTIDO_GOLES
if object_id('get_partido_goles') is not null
begin
	DROP PROCEDURE get_partido_goles
end
GO
CREATE PROCEDURE get_partido_goles @ID_PARTIDO int,@ID_EQUIPO_CASA int,@ID_EQUIPO_VISITA int
AS BEGIN
	SELECT re.*
	FROM (
		SELECT 1 AS 'NUMERO_EQUIPO',inci.MINUTO,CONCAT(ju.NOMBRE,' ',ju.APELLIDOS) AS 'NOMBRE'
		FROM (
			SELECT ID_INCIDENCIA,ID_ALINEACION,MINUTO
			FROM INCIDENCIA
			WHERE ID_PARTIDO = @ID_PARTIDO
		) inci
		inner join GOL gl
		on (inci.ID_INCIDENCIA = gl.ID_INCIDENCIA)
		inner join ALINEACION al
		on (inci.ID_ALINEACION=al.ID_ALINEACION)
		inner join (
			SELECT ID_INSCRIPCION_JUGADOR,ID_INSCRIPCION_EQUIPO,ID_JUGADOR
			FROM INSCRIPCION_JUGADOR
			WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_CASA
		) ij
		on (al.ID_INSCRIPCION_JUGADOR = ij.ID_INSCRIPCION_JUGADOR)
		inner join JUGADOR ju
		on (ij.ID_JUGADOR=ju.ID_JUGADOR)
		UNION
		SELECT 2 AS 'NUMERO_EQUIPO',inci.MINUTO,CONCAT(ju.NOMBRE,' ',ju.APELLIDOS) AS 'NOMBRE'
		FROM (
			SELECT ID_INCIDENCIA,ID_ALINEACION,MINUTO
			FROM INCIDENCIA
			WHERE ID_PARTIDO = @ID_PARTIDO
		) inci
		inner join GOL gl
		on (inci.ID_INCIDENCIA = gl.ID_INCIDENCIA)
		inner join ALINEACION al
		on (inci.ID_ALINEACION=al.ID_ALINEACION)
		inner join (
			SELECT ID_INSCRIPCION_JUGADOR,ID_INSCRIPCION_EQUIPO,ID_JUGADOR
			FROM INSCRIPCION_JUGADOR
			WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_VISITA
		) ij
		on (al.ID_INSCRIPCION_JUGADOR = ij.ID_INSCRIPCION_JUGADOR)
		inner join JUGADOR ju
		on (ij.ID_JUGADOR=ju.ID_JUGADOR)
	) AS re
	ORDER BY re.MINUTO ASC
END
GRANT EXEC ON get_partido_goles TO app_user;
GO

-- GET ARBITROS
if object_id('get_arbitros_partido') is not null
begin
	DROP PROCEDURE get_arbitros_partido
end
GO
CREATE PROCEDURE get_arbitros_partido @ID_PARTIDO int
AS BEGIN
	
	SELECT apr.ID_ARBITRO AS 'ID_ARBITRO_PRINCIPAL',CONCAT(apr.NOMBRE,' ',apr.APELLIDOS) AS 'ARBITRO_PRINCIPAL',al1.ID_ARBITRO AS 'ID_ARBITRO_LINEA_1',CONCAT(al1.NOMBRE,' ',al1.APELLIDOS) AS 'ARBITRO_LINEA_1',al2.ID_ARBITRO AS 'ID_ARBITRO_LINEA_2',CONCAT(al2.NOMBRE,' ',al2.APELLIDOS) AS 'ARBITRO_LINEA_2',a4.ID_ARBITRO AS 'ID_ARBITRO_CUARTO',CONCAT(a4.NOMBRE,' ',a4.APELLIDOS) AS 'ARBITRO_CUARTO'
	FROM (
		SELECT ID_PARTIDO,ID_ARBITRO_PARTIDO
		FROM PARTIDO
		WHERE ID_PARTIDO = @ID_PARTIDO
	) pa
	inner join ARBITROS_PARTIDO ap
	on (pa.ID_ARBITRO_PARTIDO = ap.ID_ARBITRO_PARTIDO)
	inner join ARBITRO apr
	on (ap.ID_ARBITRO_PRINCIPAL=apr.ID_ARBITRO)
	inner join ARBITRO al1
	on (ap.ID_ARBITRO_LINEA1=al1.ID_ARBITRO)
	inner join ARBITRO al2
	on (ap.ID_ARBITRO_LINEA2=al2.ID_ARBITRO)
	inner join ARBITRO a4
	on (ap.ID_CUARTO_ARBITRO=a4.ID_ARBITRO)
END
GRANT EXEC ON get_arbitros_partido TO app_user;
GO

-- GET TABLA POSICION
if object_id('get_tabla_posicion') is not null
begin
	DROP PROCEDURE get_tabla_posicion
end
GO
CREATE PROCEDURE get_tabla_posicion @ID_TORNEO int
AS BEGIN
	SELECT INSEQ.NOMBRE AS 'NOMBRE', CL.PARTIDOS_JUGADOS, CL.PARTIDOS_GANADOS,CL.PARTIDOS_EMPATADOS, CL.PARTIDOS_PERDIDOS, CL.GOLES_A_FAVOR, CL.GOLES_EN_CONTRA, (CL.GOLES_A_FAVOR - CL.GOLES_EN_CONTRA) AS DIFERENCIA_GOLES, CL.PUNTOS
	FROM CLASIFICACION CL
		INNER JOIN (SELECT INS.ID_INSCRIPCION_EQUIPO, INS.ID_EQUIPO, EQ.NOMBRE
					FROM INSCRIPCION_EQUIPO INS 
						INNER JOIN (SELECT NOMBRE, ID_EQUIPO
									FROM EQUIPO) EQ
						ON INS.ID_EQUIPO = EQ.ID_EQUIPO
					WHERE INS.ID_TORNEO = @ID_TORNEO) INSEQ
		ON INSEQ.ID_INSCRIPCION_EQUIPO = CL.ID_INSCRIPCION_EQUIPO
	ORDER BY CL.PUNTOS DESC, DIFERENCIA_GOLES DESC, GOLES_A_FAVOR DESC, GOLES_EN_CONTRA DESC
END
GRANT EXEC ON get_tabla_posicion TO app_user;
GO

-- GET TABLA GOLEADORES
if object_id('get_tabla_goleadores') is not null
begin
	DROP PROCEDURE get_tabla_goleadores
end
GO
CREATE PROCEDURE get_tabla_goleadores @ID_TORNEO int
AS BEGIN
	SELECT CONCAT(jug.NOMBRE,' ',jug.APELLIDOS) AS 'NOMBRE',re.GOLES
	FROM JUGADOR jug
	inner join (
		SELECT ju.ID_JUGADOR,count(inc.ID_INCIDENCIA) AS GOLES
		FROM INCIDENCIA inc
		inner join GOL gl
		on (inc.ID_INCIDENCIA=gl.ID_INCIDENCIA)
		inner join (
			SELECT ID_PARTIDO
			FROM PARTIDO
			WHERE ID_TORNEO = @ID_TORNEO
		) pa
		on (inc.ID_PARTIDO=pa.ID_PARTIDO)
		inner join ALINEACION al
		on (inc.ID_ALINEACION=al.ID_ALINEACION)
		inner join INSCRIPCION_JUGADOR ij
		on (al.ID_INSCRIPCION_JUGADOR=ij.ID_INSCRIPCION_JUGADOR)
		inner join JUGADOR ju
		on (ij.ID_JUGADOR=ju.ID_JUGADOR)
		GROUP BY ju.ID_JUGADOR
	) re
	on (jug.ID_JUGADOR=re.ID_JUGADOR)
END
GRANT EXEC ON get_tabla_goleadores TO app_user;
GO

--Funci�n para contar los jugadores inscritos de un equipo en un torneo --ingresada
IF object_id('contar_jugadores_inscritos') is not null
begin
	DROP FUNCTION contar_jugadores_inscritos
end
GO
CREATE FUNCTION contar_jugadores_inscritos (@ID_EQUIPO int, @ID_TORNEO int)
	RETURNS int
	AS
	BEGIN
		RETURN (SELECT COUNT(IJ.ID_JUGADOR)
				FROM TORNEO T
				INNER JOIN INSCRIPCION_EQUIPO IE
					ON (IE.ID_TORNEO = T.ID_TORNEO)
				INNER JOIN INSCRIPCION_JUGADOR IJ
					ON (IJ.ID_INSCRIPCION_EQUIPO = IE.ID_INSCRIPCION_EQUIPO)
				WHERE (IE.ID_EQUIPO = @ID_EQUIPO) and (IE.ID_TORNEO = @ID_TORNEO)
				)
	END 
GO
GRANT EXEC ON contar_jugadores_inscritos TO adm_user;
GO

-- COMPROBAR_TORNEO
-- Procedimiento almacenado que se encarga de cambiar el estado de un torneo de 'R' a 'E'
IF object_id('comprobar_torneo') is not null
begin
	DROP PROCEDURE comprobar_torneo
end
GO
CREATE PROCEDURE comprobar_torneo @ID_TORNEO int
	AS 
	BEGIN
		CREATE TABLE #EQUIPOS_INSCRITOS(
			ID_EQUIPO_TEMP INT
		)
		INSERT INTO #EQUIPOS_INSCRITOS (ID_EQUIPO_TEMP)
			SELECT ID_INSCRIPCION_EQUIPO
			FROM INSCRIPCION_EQUIPO
			WHERE ID_TORNEO = @ID_TORNEO
		DECLARE @ID_TEMP INT
		DECLARE CURSOR_EQ CURSOR
		FOR
		SELECT ID_EQUIPO_TEMP
		FROM #EQUIPOS_INSCRITOS
		OPEN CURSOR_EQ
		FETCH NEXT FROM CURSOR_EQ INTO @ID_TEMP
		DECLARE @ESTADO INT = 1
		WHILE @@FETCH_STATUS = 0
		BEGIN
			DECLARE @CANT INT 
			SET @CANT = (SELECT dbo.contar_jugadores_inscritos(@ID_TEMP,@ID_TORNEO))
			IF @CANT >= 15 AND @CANT <=22
				BEGIN
					FETCH NEXT FROM CURSOR_EQ INTO @ID_TEMP
				END
			ELSE
				BEGIN
					SET @ESTADO = 0
					BREAK
				END
		END
		IF @ESTADO = 1
		BEGIN
			UPDATE TORNEO SET ESTADO_TORNEO = 'E'
			WHERE ID_TORNEO = @ID_TORNEO
		END
		ELSE
		BEGIN
			RAISERROR (15600,-1,-1, 'No se logr� cambiar el estado');
		END
	END
GO
GRANT EXEC ON comprobar_torneo TO adm_user;
GO

-- ADD_PARTIDO
IF object_id('add_partido') is not null
begin
	DROP PROCEDURE add_partido
end
GO
CREATE PROCEDURE add_partido @ID_TORNEO int, @ID_JORNADA int, @ID_EQUIPO_CASA int, @ID_EQUIPO_VISITA int, @FECHA_PARTIDO datetime, @ID_UBICACION int
AS BEGIN
   INSERT INTO PARTIDO VALUES(@ID_TORNEO, @ID_JORNADA, @ID_EQUIPO_CASA, @ID_EQUIPO_VISITA, @ID_UBICACION, null, @FECHA_PARTIDO, 0, 0, 'P',null)
END
GRANT EXEC ON add_partido TO adm_user;
GO

-- ADD_JORNADA
IF object_id('add_jornada') is not null
begin
	DROP PROCEDURE add_jornada
end
GO
CREATE PROCEDURE add_jornada
    @ID_TORNEO int,
	@ID_JORNADA int,
    @FECHA datetime
AS BEGIN
INSERT INTO JORNADA VALUES(@ID_TORNEO,@ID_JORNADA,@FECHA)
END
GRANT EXEC ON add_jornada TO adm_user;
GO

-- GET_UBICACION_EQUIPO
IF object_id('get_ubicacion_equipo') is not null
begin
	DROP PROCEDURE get_ubicacion_equipo
end
GO
CREATE PROCEDURE get_ubicacion_equipo
    @ID_EQUIPO_INSCRITO int
AS BEGIN
	SELECT e.ID_UBICACION
	FROM (
		SELECT ID_EQUIPO
		FROM INSCRIPCION_EQUIPO
		WHERE ID_INSCRIPCION_EQUIPO = @ID_EQUIPO_INSCRITO
	) ie
	inner join EQUIPO e
	on (ie.ID_EQUIPO=e.ID_EQUIPO)
END
GRANT EXEC ON get_ubicacion_equipo TO adm_user;
GO

-- ACTUALIZAR_TORNEO
IF object_id('actualizar_torneo') is not null
begin
	DROP PROCEDURE actualizar_torneo
end
GO
CREATE PROCEDURE actualizar_torneo
    @ID_TORNEO int
AS BEGIN
	UPDATE TORNEO
	SET ESTADO_TORNEO = 'E'
	WHERE ID_TORNEO = @ID_TORNEO
END
GRANT EXEC ON actualizar_torneo TO adm_user;
GO

--GET_ARBITROS
if object_id('get_arbitros') is not null
begin
	DROP PROCEDURE get_arbitros
end
GO
CREATE PROCEDURE get_arbitros AS
	BEGIN
		SELECT ID_ARBITRO, CONCAT(NOMBRE,' ',APELLIDOS) AS NOMBRE, FECHA_NACIMIENTO, TIPO_ARBITRO
		FROM ARBITRO
		ORDER BY NOMBRE ASC
	END
GO
GRANT EXEC ON get_arbitros TO adm_user;
GO

/* SE ELIMINAN TODO TIPO DE PERMISOS A app_user */
REVOKE ALL ON ALINEACION TO app_user;
GO
REVOKE ALL ON ARBITRO TO app_user;
GO
REVOKE ALL ON ARBITROS_PARTIDO TO app_user;
GO
REVOKE ALL ON CAMBIO TO app_user;
GO
REVOKE ALL ON CLASIFICACION TO app_user;
GO
REVOKE ALL ON ENTRENADOR TO app_user;
GO
REVOKE ALL ON ENTRENADOR_EQUIPO TO app_user;
GO
REVOKE ALL ON EQUIPO TO app_user;
GO
REVOKE ALL ON FORMATO TO app_user;
GO
REVOKE ALL ON GALERIA TO app_user;
GO
REVOKE ALL ON GOL TO app_user;
GO
REVOKE ALL ON INCIDENCIA TO app_user;
GO
REVOKE ALL ON INSCRIPCION_EQUIPO TO app_user;
GO
REVOKE ALL ON INSCRIPCION_JUGADOR TO app_user;
GO
REVOKE ALL ON JORNADA TO app_user;
GO
REVOKE ALL ON JUGADOR TO app_user;
GO
REVOKE ALL ON PAIS TO app_user;
GO
REVOKE ALL ON PARTIDO TO app_user;
GO
REVOKE ALL ON POSICION TO app_user;
GO
REVOKE ALL ON TARJETA TO app_user;
GO
REVOKE ALL ON TORNEO TO app_user;
GO
REVOKE ALL ON UBICACION TO app_user;
GO
REVOKE ALL ON MULTIMEDIA TO app_user;
GO



SELECT * FROM ENTRENADOR_EQUIPO

INSERT INTO PARTIDO VALUES (4,3,27,24,2,null,'2013-06-20',2,3,'J',null)

SELECT * FROM PARTIDO