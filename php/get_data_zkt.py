from zk import ZK, const
import json

data = []
conn = None

# Primer checador
for ip in ['172.1.20.142', '172.1.20.79']:
    zk = ZK(ip, port=4370, timeout=5)
    try:
        conn = zk.connect()
        attendance = conn.get_attendance()

        if attendance:
            for att in attendance:
                data.append({
                    "device": ip,
                    "user_id": att.user_id,
                    "timestamp": str(att.timestamp),
                    "status": att.status
                })

    except Exception as e:
        data.append({"device": ip, "error": str(e)})
    finally:
        if conn:
            conn.disconnect()

# Devolver en formato JSON
print(json.dumps(data))
