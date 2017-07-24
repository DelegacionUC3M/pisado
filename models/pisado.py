import datetime

from extensions import mongo
from utils.models import get_data_from_model


class Pisado:
    pisado_model = [{"name": "author_nia", "type": int, "nullable": False},
                    {"name": "author_email", "type": str, "nullable": False},
                    {"name": "author_name", "type": str, "nullable": False},
                    {"name": "creation_date", "type": datetime.datetime, "nullable": True,
                     "default": datetime.datetime.now},
                    {"name": "study", "type": int, "nullable": False},
                    {"name": "subject", "type": str, "nullable": False},
                    {"name": "course", "type": int, "nullable": False},
                    {"name": "group", "type": int, "nullable": False},
                    {"name": "professor", "type": str, "nullable": False},
                    {"name": "content", "type": str, "nullable": False},
                    {"name": "archived", "type": bool, "nullable": True,
                     "default": False}]

    def __init__(self, pisado):
        self.pisado = get_data_from_model(pisado, self.pisado_model)

    def save(self):
        mongo.db.pisado.insert_one(self.pisado)

    def __repr__(self):
        return str(self.serialize())

    def serialize(self):
        return {
            "id": str(self.pisado.get("_id")),
            "author_nia": self.pisado.get("author_nia"),
            "author_email": self.pisado.get("author_email"),
            "author_name": self.pisado.get("author_name"),
            "creation_date": self.pisado.get("creation_date").strftime("%Y-%m-%d %H:%M:%S"),
            "study": self.pisado.get("study"),
            "subject": self.pisado.get("subject"),
            "course": self.pisado.get("course"),
            "group": self.pisado.get("group"),
            "professor": self.pisado.get("professor"),
            "content": self.pisado.get("content"),
            "archived": self.pisado.get("archived"),
            "comments": self.pisado.get("comments")
        }
