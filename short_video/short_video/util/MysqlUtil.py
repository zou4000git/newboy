# encoding=utf8
from sqlalchemy import *
import sys

sys.path.append('../')
from config.models import *


class MysqlUtil(object):
    @staticmethod
    def sqlalchemy_object_to_dict(sqlalchemy_object, const_list=[]):
        sqlalchemy_dict = {c.name: getattr(sqlalchemy_object, c.name, None) for c in
                           sqlalchemy_object.__table__.columns}
        for const in const_list:
            sqlalchemy_dict[const] = getattr(sqlalchemy_object, const, None)
        return sqlalchemy_dict

    @staticmethod
    def hasCp(source, cp_id):
        session = build_session()
        result = session.query(GalaxyCp).filter(GalaxyCp.cp_id == cp_id).filter(
            GalaxyCp.source == source).first()
        session.close()
        return result

    @staticmethod
    def hasNews(hash):
        session = build_session()
        result = session.query(GalaxyShortVideo).filter(GalaxyShortVideo.raw_id == hash).first()
        session.close()
        return result

    @staticmethod
    def getKeyword(idx):
        session = build_session(db_name='running')
        result = session.query(JiebaDict).slice(idx, 1)[0]
        session.close()
        return result

    @staticmethod
    def insert_batch(rows):
        session = build_session()
        for row in rows:
            session.add(row)
        session.commit()
        session.close()

    @staticmethod
    def insert_one(row):
        session = build_session()
        session.add(row)
        session.commit()
        session.close()


class JiebaDict(DeclarativeBase):
    __tablename__ = 't_jieba_dict'
    id = Column('id', Integer, primary_key=True)
    word = Column('word', VARCHAR(64))


if __name__ == '__main__':
    rows = [
        GalaxyLongVideo(raw_id=123, album_id=1, url='www.qq1.com', title='test1'),
        GalaxyLongVideo(raw_id=124, album_id=1, url='www.qq2.com', title='test2'),
    ]
    MysqlUtil.insert_batch(rows)
    MysqlUtil.insert_one(GalaxyLongVideo(raw_id=123, album_id=1, url='www.qq1.com', title='test1'))
