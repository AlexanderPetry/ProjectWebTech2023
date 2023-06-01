import psycopg2
from datetime import datetime, timedelta

# Database connection details
host = 'localhost'
port = '5432'
dbname = 'your_database_name'
user = 'your_username'
password = 'your_password'
table = 'your_table_name'
row_limit = 1000  # Define the row limit for the table
delete_batch_size = 100  # Number of rows to delete in each batch

# Connect to the database
conn = psycopg2.connect(host=host, port=port, dbname=dbname, user=user, password=password)
cursor = conn.cursor()

# Check the number of rows in the table
cursor.execute(f"SELECT COUNT(*) FROM {table}")
row_count = cursor.fetchone()[0]

if row_count >= row_limit:
    # Calculate the number of rows to delete
    delete_count = row_count - row_limit

    # Define the SQL query to select the oldest rows for deletion
    select_query = f"SELECT time FROM {table} ORDER BY time LIMIT %s"

    # Select the oldest rows for deletion
    cursor.execute(select_query, (delete_count,))
    rows_to_delete = cursor.fetchall()

    # Extract the time values from the selected rows
    delete_times = [row[0] for row in rows_to_delete]

    # Define the SQL query to delete the oldest rows
    delete_query = f"DELETE FROM {table} WHERE time = ANY(%s)"

    try:
        # Delete the oldest rows in batches
        while delete_times:
            batch_times = delete_times[:delete_batch_size]
            cursor.execute(delete_query, (batch_times,))
            conn.commit()
            delete_times = delete_times[delete_batch_size:]

        print("Old rows deleted successfully.")
    except (psycopg2.Error, Exception) as e:
        conn.rollback()
        print("Failed to delete old rows:", str(e))
else:
    print("Table row count is within the limit. No deletion needed.")

# Close the database connection
cursor.close()
conn.close()